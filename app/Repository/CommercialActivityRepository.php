<?php

namespace App\Repository;

use App\Enum\EnumGeneral;
use App\Jobs\SaveNotification;
use App\Jobs\SendNotificationSeller;
use App\Models\CommercialActivity;
use App\Models\Seller;
use App\Models\UpdateCommercialActivity;


class CommercialActivityRepository
{

    protected $model;

    public function __construct(CommercialActivity $commercialActivity, private UpdateCommercialActivity $update_model)
    {
        $this->model = $commercialActivity;
    }

    public function create($fields): CommercialActivity
    {
        return $this->model->create($fields);
    }
    public function update(array $array)
    {
        return $this->update_model->create($array);
    }
    public function updateWithouApproved($id, array $array)
    {
        $commercialActivity = $this->model->findOrfail($id);
        $commercialActivity->update($array);
    }
    public function checkAndDelete(int $id)
    {
        $check = $this->update_model->where('commercial_activity_id', $id)->first();
        if ($check) {
            $check->delete();
        }
        $this->model->findOrfail($id)->update(['status' => EnumGeneral::UPDATED]);
    }
    public function actived($id)
    {
        $commercial_activity = CommercialActivity::where('seller_id', $id)->first();
        $commercial_activity->active = 1;
        $commercial_activity->save();
        // send notification to seller
        SendNotificationSeller::dispatch('Commercial Activity', 'The Commercial Activity is Active Now', $commercial_activity->seller->fcm_token,["commercial_activity_id" => $commercial_activity->id]);
        $data = [
            "title" => 'Commercial Activity',
            "title_ar" => 'النشاط التجاري',
            "content" => 'Your Commercial Activity is Active Now',
            "content_ar" => "نشاطك التجاري مفعل الأن",
            "commercial_activity_id" => $commercial_activity->id,
            "type" => "success",
            "receive_id" => $commercial_activity->seller->id,
            "type_receive" => Seller::class,
        ];
        SaveNotification::dispatch($data);
    }
    public function getById(int $id)
    {
        return $this->model->findOrfail($id);
    }
}
