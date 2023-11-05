<?php

namespace App\Actions\subscription;

use App\Enum\EnumGeneral;
use App\Jobs\SaveNotification;
use App\Jobs\SendNotificationCustomer;
use App\Models\Seller;
use App\Notifications\SendPushSellerNotification;
use App\Repository\Dashboard\Offer\OfferRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class PaidOfferAction
{
    public function __construct(private readonly OfferRepository $repository)
    {
    }

    public function execute($id)
    {
        $offer = $this->repository->getById($id);
        $array = [];
        data_set($array, 'status', EnumGeneral::APPROVED);
        data_set($array, 'approved_at', Carbon::now());
        $this->repository->changeDataOffer($id, $array);
        // send notification to seller

        Notification::send(null, new SendPushSellerNotification($offer->title, 'the Offer is ' . $array["status"], $offer->seller->fcm_token));
        $data = [
            "title" => $offer->title,
            "content" => 'Your offer is ' . $array["status"],
            "content_ar" => "عرضك لقد تم قبوله",
            "offer_id" => $id,
            "type" => "success",
            "receive_id" => $offer->seller->id,
            "type_receive" => Seller::class,
        ];
        SaveNotification::dispatch($data);
        // send notification to customers

        SendNotificationCustomer::dispatch($offer->title, 'There is a new offer', null, ["offer_id" => $offer->id]);
        $data = [
            "title" => $offer->title,
            "content" => 'There is a new offer',
            "content_ar" => "يوجد عرض جديد تم نشره",
            "offer_id" => $id,
            "type" => "public",
            "to" => "customer"
        ];
        SaveNotification::dispatch($data);
    }
}
