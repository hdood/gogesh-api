<?php

namespace App\Repository\Dashboard\CommercialActivity;

use App\Enum\EnumGeneral;
use App\Models\CommercialActivity;
use Illuminate\Support\Facades\Hash;

final class CommercialActivityRepository
{
    protected $model;

    public function __construct(CommercialActivity $commercialActivity)

    {
        $this->model = $commercialActivity;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function getById(int $id)
    {
        return $this->model->findOrfail($id);
    }
    public function getByStatus(string $status)
    {
        return $this->model->where('status', $status)->get();
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function updateApproved($id, array $array)
    {
        if ($array['status'] == EnumGeneral::APPROVED || $array['status'] == EnumGeneral::PENDING) {
            $array['reason'] = null;
        }
        $commercialActivity = $this->model->findOrfail($id);
        $commercialActivity->update($array);
    }

    public function update($id, array $array)
    {
        if ($array['status'] == EnumGeneral::APPROVED || $array['status'] == EnumGeneral::PENDING) {
            $array['reason'] = null;
        }
        data_set($array, 'phone', $array['country_code'] . '-' . $array['phone']);

        $commercialActivity = $this->model->findOrfail($id);
        $commercialActivity->update($array);
    }

    public function updatePassword($id, array $array)
    {
        data_set($array, 'password', Hash::make($array['password']));
        $commercialActivity = $this->model->findOrfail($id);
        $commercialActivity->update($array);
    }

    public function create(array $array)
    {
        data_set($array, 'password', Hash::make($array['password']));
        $this->model->create($array);
    }

    public function destroyImage($id, $id_image)
    {
        $commercialActivity = $this->model->findOrfail($id);
        $images = json_decode($commercialActivity->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $commercialActivity->images = json_encode($images_arr);
        $commercialActivity->save();
    }
}
