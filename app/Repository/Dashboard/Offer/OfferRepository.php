<?php

namespace App\Repository\Dashboard\Offer;

use App\Enum\EnumGeneral;
use App\Jobs\SaveNotification;
use App\Jobs\SendNotificationSeller;
use App\Models\Favorite;
use App\Models\Offer;
use App\Models\Seller;
use App\Models\Subscription;
use App\Models\UpdatedOffer;
use App\Repository\Api\PageableInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

final class OfferRepository implements PageableInterface
{


    public function __construct(private Offer $model, private UpdatedOffer $model_updated)
    {
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getById(int $id)
    {
        return $this->model->findOrfail($id);
    }

    public function filterOffers($service, $section, $activity, $speciality, $companyType, $season, $type, $select = null, $sort = null): LengthAwarePaginator
    {
        $today = Carbon::now();

        $customerId = Auth::guard("sanctum")->id();
        $query = $this->model->query();
        $query->with('duration');


        //     $query->join("duration_offers", "offers.duration_id", "=", "duration_offers.id")->orderByRaw("
        //     CASE
        //         WHEN DATE_ADD(offers.created_at, INTERVAL duration_offers.duration DAY) > '$today' THEN 0
        //         WHEN DATE_ADD(offers.updated_at, INTERVAL duration_offers.duration DAY) > '$today' THEN 0
        //         ELSE 1
        //     END
        // ");
        if ($service) {
            $query->whereHas('seller', function ($query) use ($service) {
                $query->whereHas('services', function ($query) use ($service) {
                    $query->where('service_id', $service);
                });
            });
        }
        if ($section) {
            $query->whereHas('seller', function ($query) use ($service) {
                $query->whereHas('sections', function ($query) use ($service) {
                    $query->where('section_id', $service);
                });
            });
        }
        if ($activity) {
            $query->whereHas('seller', function ($query) use ($activity) {
                $query->where('activity_id', $activity);
            });
        }
        if ($speciality) {
            $query->whereHas('seller', function ($query) use ($speciality) {
                $query->whereHas('specialities', function ($query) use ($speciality) {
                    $query->where('speciality_id', $speciality);
                });
            });
        }
        if ($companyType) {
            $query->whereHas("seller", function ($query) use ($companyType) {
                $query->where('type', $companyType);
            });
        }
        if ($season) {
            $query->where("season_id", $season);
        }
        $query->with(['favorites' => function ($query) use ($customerId) {
            $query->where('customer_id', $customerId);
        }]);

        $query->addSelect(['is_favorite' => Favorite::selectRaw('count(*)')
            ->whereColumn('offer_id', 'offers.id')
            ->where('customer_id', $customerId)]);

        if ($type) {
            if ($type == EnumGeneral::NEW_OFFERS) {
                $query->whereDate('offers.created_at', '>=', Carbon::now()->subDays(30));
            }

            if ($type == EnumGeneral::MOST_REQUESTED_OFFERS) {
                $query->whereHas('conversations', function ($query) {
                    $query->where('complete', 1);
                })->withCount(['conversations' => function ($query) {
                    $query->where('complete', 1);
                }])
                    ->orderByDesc('conversations_count');
            }
            if ($type == EnumGeneral::SEASONAL_OFFERS) {
                $now = now()->format('mm-dd');
                $query->whereHas('season', function ($query) use ($now) {
                    $query->where('season_start', '<', $now)
                        ->where('season_end', '>', $now);
                });
            }
        }

        if ($select) {
            if ($select == EnumGeneral::STANDING) {
                $query->whereNull('end_at');
            }
            if ($select == EnumGeneral::TODAY) {
                $query->whereDate('start_at', Carbon::now());
            }

            if ($select == EnumGeneral::TEMPORARY) {
                $query->whereNotNull('end_at');
            }
        }
        if ($sort) {
            if ($sort == EnumGeneral::PRICE_DESC) {
                $query->orderBy('price', 'desc');
            }

            if ($sort == EnumGeneral::PRICE_ASC) {
                $query->orderBy('price', 'asc');
            }

            if ($sort == EnumGeneral::DATE_DESC) {
                $query->orderBy('start_at', 'desc');
            }

            if ($sort == EnumGeneral::DATE_ASC) {
                $query->orderBy('start_at', 'asc');
            }

            if ($sort == EnumGeneral::DISCOUNT_DESC) {
                $query->orderBy('discount', 'desc');
            }

            if ($sort == EnumGeneral::DISCOUNT_ASC) {
                $query->orderBy('discount', 'asc');
            }
            # code...
        }
        $query->whereIn("offers.status", [EnumGeneral::APPROVED, EnumGeneral::UPDATED]);

        return $query->withCount("views")->paginate(16);
    }
    public function getBySeason()
    {
        $now = now()->format('mm-dd');

        $offers = $this->model->whereHas('season', function ($query) use ($now) {
            $query->where('season_start', '<', $now)
                ->where('season_end', '>', $now);
        })->where('status', EnumGeneral::APPROVED)->withCount("views")->paginate(16);
        return $offers;
    }
    public function mostRequest()
    {
        $offer = $this->model->whereHas('conversations', function ($query) {
            $query->where('complete', 1);
        })->withCount(['conversations' => function ($query) {
            $query->where('complete', 1);
        }])
            ->where('status', EnumGeneral::APPROVED)
            ->orderByDesc('conversations_count')
            ->paginate(16);
        return $offer;
    }
    public function getRelatedOffers($offer)
    {
        return $this->model->where('id', '!=', $offer->id)
            ->where("status", EnumGeneral::APPROVED)
            ->whereHas("seller", function ($query) use ($offer) {
                $query->where('type', $offer->type)
                    ->orWhere("sector_id", $offer->seller->sector_id)
                    ->orWhere("activity_id", $offer->seller->activity_id);
            })
            ->orWhereHas("specialities", function ($query) use ($offer) {
                foreach ($offer->specialities as $key => $value) {
                    $query->where('speciality_id', $value->speciality_id);
                }
            })
            ->withCount("views")->take(10)->get();
    }


    public function getOfferDetails(int $id)
    {

        return $this->model->with("seller")
            ->withCount("views")
            ->findOrfail($id);
    }

    public function createOffer($array, $id): Offer
    {
        $offer = Offer::create($array);
        $subscription = Subscription::where('seller_id', $id)->first();
        $subscription->max_offers -= 1;
        $subscription->save();
        return $offer;
    }

    public function getOffersBySeller($id, $status = null): LengthAwarePaginator
    {
        if ($status) {
            return $this->model->where('seller_id', $id)
                ->where('status', $status)
                ->withCount("views")
                ->paginate();
        } else {
            return $this->model->where('seller_id', $id)->withCount("views")->paginate();
        }
    }

    public function getSellerOfferById($sellerId, $offerId)
    {
        return $this->model->with(["reason", "duration", "seller.sector", "seller.activity", "specialities"])->where('seller_id', $sellerId)->withCount("views")->find($offerId);
    }


    public function getPaginatedOffers(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
    ): LengthAwarePaginator {
        return $this->model->where("status", EnumGeneral::APPROVED)->paginate(10);
    }

    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }

    public function delete(int $id)
    {
        return $this->model->findOrfail($id)->delete();
    }

    public function update($id, array $array)
    {
        $offer = $this->model->findOrfail($id);
        if ($offer->status != $array['status']) {
            switch ($array['status']) {
                case EnumGeneral::REJECTED:
                    SendNotificationSeller::dispatch($offer->title, 'Your offer is ' . $array['status'], $offer->seller->fcm_token, ['offer_id' => $id]);
                    $data = [
                        "title" => $offer->title,
                        "content" => 'Your offer is ' . $array["status"],
                        "content_ar" => "عرضك قد تم رفضه",
                        "offer_id" => $id,
                        "type" => "danger",
                        "receive_id" => $offer->seller->id,
                        "type_receive" => Seller::class,
                    ];
                    SaveNotification::dispatch($data);
                    break;
                case EnumGeneral::PENDING:
                    SendNotificationSeller::dispatch($offer->title, 'Your offer is ' . $array['status'], $offer->seller->fcm_token, ['offer_id' => $id]);
                    $data = [
                        "title" => $offer->title,
                        "content" => 'Your offer is ' . $array["status"],
                        "content_ar" => "عرضك قيد انتظار الموافقة",
                        "offer_id" => $id,
                        "type" => "warning",
                        "receive_id" => $offer->seller->id,
                        "type_receive" => Seller::class,
                    ];
                    SaveNotification::dispatch($data);
                    break;
                case EnumGeneral::APPROVED:
                    if ($offer->status != EnumGeneral::DRAFT) {
                        if ($offer->total > 0) {
                            data_set($array, 'status', EnumGeneral::NOT_PAID);
                            SendNotificationSeller::dispatch($offer->title, 'Your offer is ' . $array['status'], $offer->seller->fcm_token, ['offer_id' => $id]);
                            $data = [
                                "title" => $offer->title,
                                "content" => 'Your offer is ' . $array["status"],
                                "content_ar" => "عرضك قيد انتظار الدفع",
                                "offer_id" => $id,
                                "type" => "payment",
                                "receive_id" => $offer->seller->id,
                                "type_receive" => Seller::class,
                            ];
                        } elseif ($offer->total == 0) {
                            SendNotificationSeller::dispatch($offer->title, 'Your offer is ' . $array['status'], $offer->seller->fcm_token, ['offer_id' => $id]);
                            $data = [
                                "title" => $offer->title,
                                "content" => 'Your offer is ' . $array["status"],
                                "content_ar" => "عرضك قد تم الموافقة عليه",
                                "offer_id" => $id,
                                "type" => "success",
                                "receive_id" => $offer->seller->id,
                                "type_receive" => Seller::class,
                            ];
                        }
                        SaveNotification::dispatch($data);
                    } else {
                        SendNotificationSeller::dispatch($offer->title, 'Your offer is ' . $array['status'], $offer->seller->fcm_token, ['offer_id' => $id]);
                        $data = [
                            "title" => $offer->title,
                            "content" => 'Your offer is ' . $array["status"],
                            "content_ar" => "لقد تم تفعيل عرضك",
                            "offer_id" => $id,
                            "type" => "success",
                            "receive_id" => $offer->seller->id,
                            "type_receive" => Seller::class,
                        ];
                        SaveNotification::dispatch($data);
                    }

                    break;
                case EnumGeneral::DRAFT:
                    SendNotificationSeller::dispatch($offer->title, 'Your offer is Stopped', $offer->seller->fcm_token, ['offer_id' => $id]);
                    $data = [
                        "title" => $offer->title,
                        "content" => 'Your offer is Stopped',
                        "content_ar" => "عرضك قد تم ايقافه",
                        "offer_id" => $id,
                        "type" => "danger",
                        "receive_id" => $offer->seller->id,
                        "type_receive" => Seller::class,
                    ];
                    SaveNotification::dispatch($data);
                    break;
                default:
                    # code...
                    break;
            }
        }
        $offer->update($array);
        return $offer;
    }

    public function changeDataOffer($id, array $array)
    {
        $offer = $this->model->findOrfail($id);
        $offer->update($array);
        return $offer;
    }
    public function GetUpdatedOffer($id)
    {
        $offer = $this->model_updated->findOrfail($id);
        return $offer;
    }
    public function updateOfferApi($id, array $array)
    {
        $offer = $this->model->findOrfail($id);

        $array = data_set($array, 'offer_id', $id);
        $updated = $this->model_updated->create($array);
        $updated->offer->updated_id = $updated->id;
        $updated->offer->save();
        $status = $offer->status;
        if ($status == EnumGeneral::APPROVED) {
            $updated->offer->seller->subscription->max_offer_change -= 1;
            $updated->offer->seller->subscription->save();
        }
        if ($status != EnumGeneral::UPDATED) {
            $offer->update(['old_status' => $offer->status]);
        }
        $offer->update(['status' => EnumGeneral::UPDATED]);
        return $updated;
    }
    public function checkAndDelete(int $id)
    {
        $check = $this->model_updated->where('offer_id', $id)->first();
        if ($check) {
            $check->delete();
        }
    }
    public function destroyImage($id, $id_image)
    {
        $offer = $this->model->findOrfail($id);
        $images = json_decode($offer->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $offer->images = json_encode($images_arr);
        $offer->save();
    }

    public function getRequestedOffers(int $id)
    {
        return $this->model->withCount("views")->whereHas("conversations", function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('complete', 1);
        })->paginate(16);
    }
}
