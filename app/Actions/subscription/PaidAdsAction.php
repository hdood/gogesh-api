<?php

namespace App\Actions\subscription;

use App\Enum\EnumGeneral;
use App\Jobs\SaveNotification;
use App\Jobs\SendNotificationCustomer;
use App\Jobs\SendNotificationSeller;
use App\Models\Seller;
use App\Repository\Api\AdsRepository;
use Carbon\Carbon;

class PaidAdsAction
{
    public function __construct(private readonly AdsRepository $repository)
    {
    }

    public function execute($id)
    {
        $ads = $this->repository->getById($id);
        $array = [];
        data_set($array, 'status', EnumGeneral::APPROVED);
        data_set($array, 'date_end', Carbon::parse($ads->date_start)->addDays($ads->duration));
        if (Carbon::parse($ads->date_start) <= Carbon::now()) {
            data_set($array, 'date_start', Carbon::now());
            data_set($array, 'date_end', Carbon::now()->addDays($ads->duration));
        }

        $this->repository->update($id, $array);
        // send notification to seller
        SendNotificationSeller::dispatch($ads->title, 'the ad is ' . $array["status"], $ads->seller->fcm_token);
        $data = [
            "title" => $ads->title,
            "content" => 'Your Ad is ' . $array["status"],
            "content_ar" => "اعلانك لقد تم قبوله",
            "ads_id" => $id,
            "type" => "success",
            "receive_id" => $ads->seller->id,
            "type_receive" => Seller::class,
        ];
        SaveNotification::dispatch($data);
        // send notification to customers
        if ($ads->place == EnumGeneral::NOTIFICATION) {
            SendNotificationCustomer::dispatch($ads->title, 'There is a new ad', null, ["ad_id" => $id]);
            $data = [
                "title" => $ads->title,
                "content" => 'There is a new ad',
                "content_ar" => "يوجد اعلان جديد تم نشره",
                "ads_id" => $id,
                "type" => "public",
                "to" => "customer"
            ];
            SaveNotification::dispatch($data);
        }
    }
}
