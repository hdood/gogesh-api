<?php

namespace App\Actions\Favorite;

use App\Http\Requests\AddAdToFavoriteRequest;
use App\Models\Ads;
use App\Repository\FavoritesRepository;
use Illuminate\Support\Facades\Auth;

class AddAdToFavoriteAction
{

    public function __construct(private readonly FavoritesRepository $repository)
    {
    }

    public function execute(AddAdToFavoriteRequest $request)
    {
        $array = $request->validated();
        $array["customer_id"] = Auth::id();
        $array["model"] = Ads::class;
       return $this->repository->create($array);
    }

}
