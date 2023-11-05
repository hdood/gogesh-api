<?php

namespace App\Repository\Dashboard\Services;



use App\Enum\EnumGeneral;
use App\Models\Section;


final class SectionRepository
{
    protected $model;

    public function __construct(Section $model)
    {
        $this->model = $model;
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

    public function getByIdWithService($id, $q = null, $e = null)
    {
        $query = $this->model->query();
        $query->where("status", EnumGeneral::ACTIVE);
        $query->where("service_id", $id)->get();

        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('name_ar', 'LIKE', '%' . $q . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $q . '%');
            });
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }

    public function getActiveActivities()
    {
        return $this->model->where('status', EnumGeneral::ACTIVE)->get();
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        $model = $this->model->findOrfail($id);
        $model->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
