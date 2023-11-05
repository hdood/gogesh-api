<?php

namespace App\Repository\Dashboard\Offer;


use App\Models\DurationOffer;


final class DurationRepository
{
    protected $model;

    public function __construct(DurationOffer $duration)
    {
        $this->model = $duration;
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

    public function getActiveDuration()
    {
        return $this->model->where('status', "Active")->get();
    }
    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }
    public function update($id, array $array)
    {
        $duration = $this->model->findOrfail($id);
        $duration->update($array);
    }

    public function create(array $array)
    {
        $this->model->create($array);
    }
}
