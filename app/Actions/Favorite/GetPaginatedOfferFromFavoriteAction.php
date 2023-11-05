<?php

namespace App\Actions\Favorite;

use App\Repository\FavoritesRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class GetPaginatedOfferFromFavoriteAction
{

    public function __construct(private readonly FavoritesRepository $repository)
    {
    }

    public function execute():LengthAwarePaginator
    {

        $id = Auth::id();
       return $this->repository->getPaginatedOffersFromFavorites($id);

    }

}
