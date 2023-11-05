<?php

declare(strict_types=1);

namespace App\Repository\Api;

use App\Jobs\SaveNotification;
use App\Jobs\SendNotificationSeller;
use App\Models\Package;
use App\Models\Seller;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

final class SellerRepository
{
    public function create(array $fields): Seller
    {

        data_set($fields, 'password', Hash::make($fields['password']));
        return Seller::create($fields);
    }

    public function update($id, array $array)
    {
        $seller = Seller::findOrFail($id);
        $seller->update($array);
        return Seller::findOrFail($id);
    }
    public function updateAvatar($id, array $array)
    {
        $seller = Seller::findOrFail($id);
        $data = data_set($array, 'image', saveImage('avatar', $array['image']));
        $seller->update($data);
    }
    public function verification($id)
    {
        $seller = Seller::find($id);
        $seller->verification = 1;
        $seller->save();
        // send notification to seller
        SendNotificationSeller::dispatch('Verification', 'The Account is Verification', $seller->fcm_token, ["seller_id" => $id]);
        $data = [
            "title" => 'Verification',
            "title_ar" => 'توثيق',
            "content" => 'Your Account is Verification Now',
            "content_ar" => "حسابك أصبح موثق الأن",
            "type" => "success",
            "receive_id" => $seller->id,
            "type_receive" => Seller::class,
        ];
        SaveNotification::dispatch($data);
    }

    public function getById(int $id): Seller
    {
        return Seller::findOrFail($id);
    }

    public function firstOrCreate(array $email, array $fields): Seller
    {
        return Seller::firstOrCreate($email, $fields);
    }
    function firstWhere($array): Seller
    {
        return Seller::firstWhere($array);
    }

    public function actived($id)
    {
        $seller = Seller::findOrfail($id);
        $seller->actived = 1;
        $seller->save();
        // send notification to seller
        SendNotificationSeller::dispatch('Commercial Activity', 'The Commercial Activity is Active Now', $seller->fcm_token, ["seller_id" => $seller->id]);
        $data = [
            "title" => 'Commercial Activity',
            "title_ar" => 'النشاط التجاري',
            "content" => 'Your Commercial Activity is Active Now',
            "content_ar" => "نشاطك التجاري مفعل الأن",
            "seller_id" => $seller->id,
            "type" => "success",
            "receive_id" => $seller->id,
            "type_receive" => Seller::class,
        ];
        SaveNotification::dispatch($data);
        $package = Package::where('price', 0.00)->first();
        $packageData = $package->toArray();

        unset($packageData['status']);

        $packageData['seller_id'] = $id;
        $currentSubscription =  Subscription::create($packageData);
        return $currentSubscription;
    }


    public function searchUsersByFullName(string $text): Collection
    {
        $names = explode(' ', $text);

        return Seller::whereIn('first_name', $names)
            ->orWhereIn('middle_name', $names)
            ->orWhereIn('last_name', $names)->get();
    }

    public function save(Seller $user): Seller
    {
        $user->save();

        return $user;
    }

    public function delete(Seller $user): ?bool
    {
        return $user->delete();
    }

    public function getAll(): Collection
    {
        return Seller::query()->orderBy('id', 'asc')->get();
    }

    public function getUsersByHR(int $id): Collection
    {
        return Seller::query()->where([['manager_id', $id]])->get();
    }
}
