<?php

namespace App\Repository\Dashboard\Categories;


use App\Models\Season;
use App\Enum\EnumGeneral;


final class SeasonRepository
{
    protected $model;

    public function __construct(Season $season)
    {
        $this->model = $season;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }
    public function getByStatus(string $status, $q = null, $e = null)
    {
        $query = $this->model->query();
        $query->where('status', $status);
        if ($q) {
            $query->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%');
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }
    public function getActiveSeasons($q = null)
    {
        $query = $this->model->query();
        if ($q) {
            $query->where('status', EnumGeneral::ACTIVE)
                ->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%');
        } else {
            $query->where('status', EnumGeneral::ACTIVE);
        }
        return $query->paginate(16);
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        $season = $this->model->findOrfail($id);
        $season->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
