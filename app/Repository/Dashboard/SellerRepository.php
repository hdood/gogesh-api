<?php

namespace App\Repository\Dashboard;

use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

final class SellerRepository
{
    protected $model;

    public function __construct(Seller $seller)
    {
        $this->model = $seller;
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
    public function update($id, array $array)
    {
        $seller = $this->model->findOrfail($id);
        try {
            $seller->sections()->delete();

            foreach ($array['sections_id'] as $key => $value) {
                $seller->sections()->create([
                    'seller_id' => $seller->id,
                    'section_id' => $value
                ]);
            }
            $seller->services()->delete();
            foreach ($array['services_id'] as $key => $value) {
                $seller->services()->create([
                    'seller_id' => $seller->id,
                    'service_id' => $value
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            data_set($array, 'phone', $array['country_code'] . '-' . $array['phone']);
            data_set($array, 'commercial_activity_phone', $array['country_code_commercial'] . '-' . $array['commercial_activity_phone']);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $seller->update($array);
    }

    

    public function updatePassword($id, array $array)
    {
        data_set($array, 'password', Hash::make($array['password']));
        $seller = $this->model->findOrfail($id);
        $seller->update($array);
    }



    public function create(array $array)
    {
        data_set($array, 'password', Hash::make($array['password']));
        data_set($array, 'phone', $array['country_code'] . '-' . $array['phone']);
        $array['completed'] = 1;
        $this->model->create($array);
    }

    public function delete($id)
    {
        $this->model->findOrfail($id)->delete();
    }

    public function destroyImage($id, $id_image)
    {
        $seller = $this->model->findOrfail($id);
        $images = json_decode($seller->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $seller->images = json_encode($images_arr);
        $seller->save();
    }
}
