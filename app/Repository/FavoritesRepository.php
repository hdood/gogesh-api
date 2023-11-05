<?php

namespace App\Repository;

use App\Models\Customer;
use App\Models\Favorite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FavoritesRepository
{


    public function create($array)
    {
       return Favorite::create($array);
    }

    public function deleteAdFromFavorites($id)
    {
        return Favorite::where("ad_id",$id)->delete();
    }

    public function deleteOfferFromFavorites($id)
    {
        return Favorite::where("offer_id",$id)->delete();
    }


    public function getPaginatedOffersFromFavorites($id): LengthAwarePaginator
    {
        return Customer::findOrFail($id)->favourites()
            ->selectRaw('*, 1 as is_favorite')
            ->paginate(16);
    }


}
