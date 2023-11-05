<?php

namespace App\Repository\Dashboard\Categories;


use App\Enum\EnumGeneral;
use App\Models\SubSector;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


final class SubSectorRepository
{
    protected $model;

    public function __construct(SubSector $sector)

    {
        $this->model = $sector;
    }
    public function all()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }
    public function getByIdWithActivities($id, $q = null, $e = null)
    {
        $query = $this->model->where('id', $id)->where("status", EnumGeneral::ACTIVE);
        if ($q) {
            $query->whereHas('activities', function ($query) use ($q) {
                $query->where("status", EnumGeneral::ACTIVE)
                    ->where('name_ar', 'LIKE', '%' . $q . '%')
                    ->Orwhere('name_en', 'LIKE', '%' . $q . '%');
            });
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }
    public function getByStatus(string $status)
    {
        return $this->model->where('status', $status)->get();
    }

    public function getBySectors($id, $q = null, $e = null)
    {
        $query = $this->model->where('sector_id', $id);
        if ($q) {
            $query->where("status", EnumGeneral::ACTIVE)
                ->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%')
                ->where('sector_id', $id);
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }

    public function getActiveSubSectors($q = null, $e = null)
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::ACTIVE);
        if ($q) {
            $query->where('name_ar', 'LIKE', '%' . $q . '%')
                ->Orwhere('name_en', 'LIKE', '%' . $q . '%')
                ->where('status', EnumGeneral::ACTIVE);
        }
        if ($e) {
            return $query->paginate(16);
        }
        return $query->get();
    }
    public function getPaginatedSectors($type, $q = null): LengthAwarePaginator
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::ACTIVE);
        if ($type) {
            $query->whereHas('commercialActivities', function ($query) use ($type) {
                $query->where("status", EnumGeneral::APPROVED)->where('type', $type);
            });
        }
        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('name_ar', 'LIKE', '%' . $q . '%')
                    ->orWhere('name_en', 'LIKE', '%' . $q . '%');
            });
        }
        $query->withCount('commercialActivities');

        return $query->paginate(16);
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        $sector = $this->model->findOrfail($id);
        $sector->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
