<?php

namespace App\Http\Controllers\Api\Offer;

use App\Actions\Favorite\AddOfferToFavoriteAction;
use App\Actions\Favorite\DeleteOfferFromFavoriteAction;
use App\Actions\Favorite\GetPaginatedOfferFromFavoriteAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Offer\OfferFavoriteRequest;
use App\Http\Resources\Api\Offer\ShortInfoOfferResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferFavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetPaginatedOfferFromFavoriteAction $action): PaginateResource
    {
        $response = $action->execute();
        return new PaginateResource($action->execute(),ShortInfoOfferResource::collection($response->items()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferFavoriteRequest $request, AddOfferToFavoriteAction $action): JsonResponse
    {
        $action->execute($request);
        return new JsonResponse(["message" => __("favorites.offer_add_to_favorites")]);
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
    public function destroy(int $id,DeleteOfferFromFavoriteAction $action): JsonResponse
    {
        $action->execute($id);
        return new JsonResponse(["message" => __("favorites.offer_deleted_from_favorites")]);
    }
}
