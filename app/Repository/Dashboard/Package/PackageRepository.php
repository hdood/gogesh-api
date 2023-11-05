<?php

namespace App\Repository\Dashboard\Package;

use App\Enum\EnumGeneral;
use App\Models\Package;
use DataTables;
use Ramsey\Uuid\Type\Integer;

final class PackageRepository
{
    protected $model;

    public function __construct(Package $package)
    {
        $this->model = $package;
    }
    public function all()
    {
        return $this->model->all();
    }

    public function getByStatus(string $status)
    {
        return $this->model->where('status', $status)->get();
    }

    public function getById(int $id)
    {
        return $this->model->findOrfail($id);
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        data_set($array, 'features', json_encode($array['features']));
        $package = $this->model->findOrfail($id);
        $package->update($array);
    }
    public function create($array)
    {
        data_set($array, 'features', json_encode($array['features']));
        data_set($array, 'features_ar', json_encode($array['features_ar']));
        $this->model->create($array);
    }
    public function destroyImage($id, $id_image)
    {
        $package = $this->model->findOrfail($id);
        $images = json_decode($package->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $package->images = json_encode($images_arr);
        $package->save();
    }
}
