<?php

namespace App\Repository\Dashboard\Offer;

use App\Enum\EnumGeneral;
use App\Models\Offer;
use App\Models\ReasonOffer;
use DataTables;
use Ramsey\Uuid\Type\Integer;

final class ReasonRepository
{
    protected $model;

    public function __construct(ReasonOffer $reason)
    {
        $this->model = $reason;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        $reason = $this->model->findOrfail($id);
        $reason->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
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
}
