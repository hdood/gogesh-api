<?php

namespace App\Repository\Dashboard\Categories;


use App\Enum\EnumGeneral;
use App\Models\Speciality;


final class SpecialityRepository
{
    protected $model;

    public function __construct(Speciality $speciality)
    {
        $this->model = $speciality;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }

    public function getByActivity($id)
    {
        return $this->model->where('activity_id', $id)->get();
    }

    public function getActiveSpecializations($q = null, $e = null)
    {
        $query = $this->model->where('status', EnumGeneral::ACTIVE);
        if ($q) {
            $query->where("status", EnumGeneral::ACTIVE)
                ->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%');
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }

    public function getByIdWithActivity($id, $q = null, $e = null)
    {
        $query = $this->model->query();
        $query->where("status", EnumGeneral::ACTIVE);
        $query->where("activity_id", $id);
        if ($q) {
            $query->where(function ($query) use ($q, $id) {
                $query->where('name_ar', 'LIKE', '%' . $q . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $q . '%')
                    ->where("activity_id", $id);
            });
        }
        if ($e) {
            return $query->paginate(16);
            # code...
        }
        return $query->get();
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
        $speciality = $this->model->findOrfail($id);
        $speciality->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
