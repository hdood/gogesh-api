<?php

namespace App\Actions\Favorite;

use App\Http\Requests\Api\Offer\OfferFavoriteRequest;
use App\Models\Offer;
use App\Repository\FavoritesRepository;
use Illuminate\Support\Facades\Auth;

class AddOfferToFavoriteAction
{

    public function __construct(private readonly FavoritesRepository $repository)
    {
    }

    public function execute(OfferFavoriteRequest $request)
    {
        $array = $request->validated();
        $array["customer_id"] = Auth::id();
        $array["model"] = Offer::class;
       return $this->repository->create($array);
    }

}
