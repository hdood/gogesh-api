<?php

namespace App\Repository\Dashboard\Locations;

use App\Enum\EnumGeneral;
use App\Models\Country;
use App\Models\Offer;
use App\Models\ReasonOffer;
use DataTables;
use Ramsey\Uuid\Type\Integer;

final class CountriesRepository
{
    protected $model;

    public function __construct(Country $country)
    {
        $this->model = $country;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }
    public function getByStatus(string $status)
    {
        return $this->model->where('status', $status)->get();
    }
    public function getAll($q = null, $e = null)
    {
        // return $this->model->where('status', $status)->get();
        $query = $this->model->where("status", EnumGeneral::ACTIVE);
        if ($q) {
            $query->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%')
                ->where("status", EnumGeneral::ACTIVE);
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        $country = $this->model->findOrfail($id);
        $country->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
