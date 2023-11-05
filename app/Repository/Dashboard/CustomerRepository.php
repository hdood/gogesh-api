<?php

namespace App\Repository\Dashboard;

use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

final class CustomerRepository
{
    protected $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
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
        data_set($array, 'phone', $array['country_code'] . '-' . $array['phone']);

        if (!empty($array['password'])) {
            $array['password'] = Hash::make($array['password']);
        } else {
            $array = Arr::except($array, array('password'));
        }
        $customer = $this->model->findOrfail($id);
        $customer->update($array);
    }

    public function updatePassword($id, array $array)
    {
        data_set($array, 'password', Hash::make($array['password']));
        $customer = $this->model->findOrfail($id);
        $customer->update($array);
    }

    public function create(array $array)
    {
        data_set($array, 'password', Hash::make($array['password']));
        data_set($array, 'phone', $array['country_code'] . '-' . $array['phone']);
        $array['completed'] = 1;
        $this->model->create($array);
    }

    public function destroyImage($id, $id_image)
    {
        $customer = $this->model->findOrfail($id);
        $images = json_decode($customer->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $customer->images = json_encode($images_arr);
        $customer->save();
    }
}
