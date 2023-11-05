<?php

namespace App\Actions\Favorite;

use App\Repository\FavoritesRepository;

class DeleteOfferFromFavoriteAction
{

    public function __construct(private FavoritesRepository $repository)
    {
    }

    public function execute($id): void
    {
        $this->repository->deleteOfferFromFavorites($id);
    }

}
