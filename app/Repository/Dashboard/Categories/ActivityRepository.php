<?php

namespace App\Repository\Dashboard\Categories;


use App\Enum\EnumGeneral;
use App\Models\Activity;


final class ActivityRepository
{
    protected $model;

    public function __construct(Activity $activity)
    {
        $this->model = $activity;
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

    public function getBySubSector($id, $q = null, $e = null)
    {
        $query = $this->model->where('sub_sector_id', $id);
        if ($q) {
            $query->where("status", EnumGeneral::ACTIVE)
                ->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%')
                ->where('sub_sector_id', $id);
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }

    public function getBySector($id, $e = null)
    {
        $query = $this->model->whereHas('subSector', function ($query) use ($id) {
            $query->where('sector_id', $id)->where('status', EnumGeneral::ACTIVE);
        })->where('status', EnumGeneral::ACTIVE);

        if (!$e) {
            return $query->paginate(16);
        }
        return $query->get();
    }

    public function getActiveActivities($q = null, $e = null)
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::ACTIVE);
        if ($q) {
            $query->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%');
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
        $activity = $this->model->findOrfail($id);
        $activity->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
