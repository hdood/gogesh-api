<?php

namespace App\Repository\Api;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerRepository
{

    public function create(array $fields): Customer
    {
        data_set($fields, 'password', Hash::make($fields['password']));
        return Customer::create($fields);
    }
    public function update($id, array $array)
    {
        $seller = Customer::findOrFail($id);
        return $seller->update($array);
    }
    
    public function getById(int $id): Customer
    {
        return Customer::findOrFail($id);
    }

    public function firstOrCreate(array $email, array $fields): Customer
    {
        return Customer::firstOrCreate($email, $fields);
    }

    function firstWhere($array): Customer
    {
        return Customer::firstWhere($array);
    }

    public function searchUsersByFullName(string $text): Collection
    {
        $names = explode(' ', $text);

        return Customer::whereIn('first_name', $names)
            ->orWhereIn('middle_name', $names)
            ->orWhereIn('last_name', $names)->get();
    }

    public function save(Customer $user): Customer
    {
        $user->save();

        return $user;
    }

    public function delete(Customer $user): ?bool
    {
        return $user->delete();
    }

    public function getAll(): Collection
    {
        return Customer::query()->orderBy('id', 'asc')->get();
    }

    public function getUsersByHR(int $id): Collection
    {
        return Customer::query()->where([['manager_id', $id]])->get();
    }
}
