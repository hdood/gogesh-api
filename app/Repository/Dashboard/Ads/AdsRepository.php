<?php

namespace App\Repository\Dashboard\Ads;


use App\Models\Ads;
use App\Enum\EnumGeneral;
use App\Jobs\SendNotificationSeller;
use App\Models\AdsView;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


final class AdsRepository
{
    protected $model;

    public function __construct(Ads $ads, private AdsView $adsView)
    {
        $this->model = $ads;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }

    public function addView($array)
    {
        $this->adsView->create($array);
    }

    public function getByIdApproved($id)
    {
        return $this->model->withCount("views")
            ->with("seller")->where('status', EnumGeneral::APPROVED)->whereid($id)->firstOrfail();
    }

    public function getPaginatedAds($status = EnumGeneral::APPROVED, $type = null,): LengthAwarePaginator
    {
        if ($type) {
            return $this->model->withCount("views")
                ->where("place", EnumGeneral::ADS_SECREEN)
                ->Orwhere('poster_type', $type)
                ->where('status', $status)
                ->paginate(15);
        }
        return $this->model->withCount("views")->where('status', EnumGeneral::APPROVED)->where("place", EnumGeneral::ADS_SECREEN)->latest()->paginate(15);
    }

    public function getSectorFlashAd($sector)
    {
        $query = $this->model->query();
        $query->withCount("views");
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('sector_id', $sector);
        $query->where('place', EnumGeneral::SECTOR_FLASH);
        return $query->inRandomOrder()->firstOrFail();
    }

    public function getSectorsBannerAds()
    {
        $query = $this->model->query();
        $query->withCount("views");

        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::SECTORS_BANER);
        return $query->paginate(16);
    }

    public function getSectorBannerAds($sector)
    {
        $query = $this->model->query();
        $query->withCount("views");

        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::SECTOR_BANER);
        $query->where('sector_id', $sector);

        return $query->paginate(16);
    }

    public function getHomeFlashAd()
    {
        $query = $this->model->query();
        $query->withCount("views");

        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::HOME_FLASH);
        return $query->inRandomOrder()->firstOrFail();
    }

    public function getHomeBannerAds()
    {
        $query = $this->model->query();
        $query->withCount("views");

        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::HOME_BANER);
        return $query->paginate(16);
    }

    public function getSearchBannerAds()
    {
        $query = $this->model->query();
        $query->withCount("views");

        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::SEARCH_BANER);
        return $query->paginate(16);
    }


    public function getPaginatedAdsBySeller($status): LengthAwarePaginator
    {
        if (get_class(Auth::user()) == Seller::class) {
            $userId = Auth::id();
        } else {
            $userId = Auth::user()->seller->id;
        }
        if ($status) {
            return $this->model->where('seller_id', $userId)->where('status', $status)->paginate(15);
        }
        return $this->model->where('seller_id', $userId)->paginate(15);
    }

    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }

    public function update($id, array $array)
    {
        $ads = $this->model->findOrfail($id);
        if ($ads->status != EnumGeneral::APPROVED) {
            # code...
            if ($array['status'] == EnumGeneral::APPROVED) {
                // $date_end = Carbon::parse($request->date_start)->addDays($request->duration);
                // $data["date_end"] = $date_end;
                if ($ads->total != 0) {
                    $array["status"] = EnumGeneral::NOT_PAID;
                    try {
                        SendNotificationSeller::dispatch('title', 'complete payment the ad', $ads->seller->fcm_token);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                } else {
                    try {
                        SendNotificationSeller::dispatch($ads->title, 'the ad is ' . $array["status"], $ads->seller->fcm_token);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            } else {
                try {
                    SendNotificationSeller::dispatch($ads->title, 'the ad is ' . $array["status"], $ads->seller->fcm_token);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            $ads->update($array);
        }
    }

    public function create($array)
    {
        return $this->model->create($array);
    }

    public function destroyImage($id, $id_image)
    {
        $ads = $this->model->findOrfail($id);
        $images = json_decode($ads->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $ads->images = json_encode($images_arr);
        $ads->save();
    }
}
