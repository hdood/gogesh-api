<?php

namespace App\Repository\Dashboard\Services;


use App\Enum\EnumGeneral;
use App\Models\Services;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


final class ServiceRepository
{
    protected $model;

    public function __construct(Services $model)

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
    public function getByIdWithSections($id, $q = null)
    {
        $query = $this->model->findOrfail($id)->sections->where(function ($query) use ($q) {
            $query->where('name_ar', 'LIKE', '%' . $q . '%')
                ->orWhere('name_en', 'LIKE', '%' . $q . '%');
        });
        // if ($q) {
        //     $query->whereHas('sections', function ($query) use ($q) {
        //         $query->where("status", EnumGeneral::ACTIVE)
        //             ->where('name_ar', 'LIKE', '%' . $q . '%')
        //             ->Orwhere('name_en', 'LIKE', '%' . $q . '%');
        //     });
        // } else {
        //     $query->whereHas('sections', function ($query) use ($q) {
        //         $query->where("status", EnumGeneral::ACTIVE);
        //     });
        // }

        dd($query);
        return $query->paginate(16);
    }
    public function getByStatus(string $status, $q = null, $e = null)
    {
        if ($e) {
            if ($q) {
                return $this->model->where('status', $status)
                    ->where('name_ar', 'LIKE', '%' . $q . '%')
                    ->Orwhere('name_en', 'LIKE', '%' . $q . '%')
                    ->paginate(16);
                # code...
            }
            return $this->model->where('status', $status)->paginate(16);
            # code...
        }
        return $this->model->where('status', $status)->get();
    }

    public function getActiveSectors()
    {
        return $this->model->where('status', EnumGeneral::ACTIVE)->get();
    }

    public function getPaginatedSectors($type): LengthAwarePaginator
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::ACTIVE);
        if ($type) {
            $query->whereHas('commercialActivities', function ($query) use ($type) {
                $query->where("status", EnumGeneral::APPROVED)->where('type', $type);
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
        $model = $this->model->findOrfail($id);
        $model->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
