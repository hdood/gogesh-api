<?php

namespace App\Http\Controllers\Api\Ads;

use App\Actions\Favorite\AddAdToFavoriteAction;
use App\Actions\Favorite\DeleteAdFromFavoriteAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddAdToFavoriteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /// TODO: return ads from favorites
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAdToFavoriteRequest $request, AddAdToFavoriteAction $action): JsonResponse
    {
        $action->execute($request);
        return new JsonResponse(["message" => __("favorites.ad_add_to_favorites")]);
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id,DeleteAdFromFavoriteAction $action): JsonResponse
    {
        $action->execute($id);
        return new JsonResponse(["message" => __("favorites.ad_deleted_from_favorites")]);
    }
}
