<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Models\UserCommecrialActivity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class UserCommercialRepository
{
    public function create(array $fields): UserCommecrialActivity
    {
        data_set($fields, 'password', Hash::make($fields['password']));
        $fields['seller_id'] = Auth::user()->id;
        $user = UserCommecrialActivity::create($fields);
        $user->seller->subscription->max_users -= 1;
        $user->seller->subscription->save();
        return $user;
    }

    public function update($id, array $array)
    {
        $UserCommecrialActivity = UserCommecrialActivity::findOrFail($id);
        $UserCommecrialActivity->update($array);
    }
    public function updateAvatar($id, array $array)
    {
        $UserCommecrialActivity = UserCommecrialActivity::findOrFail($id);
        $data = data_set($array, 'image', saveImage('avatar', $array['image']));
        $UserCommecrialActivity->update($data);
    }
    /**
     * @param  int  $id
     * @return User
     *
     * @throws ModelNotFoundException
     */
    public function getById(int $id): UserCommecrialActivity
    {
        return UserCommecrialActivity::findOrFail($id);
    }

    public function firstOrCreate(array $fields): UserCommecrialActivity
    {
        return UserCommecrialActivity::firstOrCreate($fields);
    }

    function firstWhere($array): UserCommecrialActivity
    {
        return UserCommecrialActivity::firstWhere($array);
    }




    public function searchUsersByFullName(string $text): Collection
    {
        $names = explode(' ', $text);

        return UserCommecrialActivity::whereIn('first_name', $names)
            ->orWhereIn('middle_name', $names)
            ->orWhereIn('last_name', $names)->get();
    }

    public function save(UserCommecrialActivity $user): UserCommecrialActivity
    {
        $user->save();

        return $user;
    }

    public function delete(UserCommecrialActivity $user): ?bool
    {
        return $user->delete();
    }

    public function getAll(): Collection
    {
        return UserCommecrialActivity::query()->orderBy('id', 'asc')->get();
    }

    public function getUsersByHR(int $id): Collection
    {
        return UserCommecrialActivity::query()->where([['manager_id', $id]])->get();
    }
}
