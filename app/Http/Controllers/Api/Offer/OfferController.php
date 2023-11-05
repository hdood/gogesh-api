<?php

namespace App\Http\Controllers\Api\Offer;


use App\Actions\Offer\CreateOfferAction;
use App\Actions\Offer\DeleteOfferAction;
use App\Actions\Offer\GetCustomerOfferDetailsAction;
use App\Actions\Offer\GetDetailsUpdateOfferAction;
use App\Actions\Offer\GetOffersAction;
use App\Actions\Offer\GetOffersMostRequestAction;
use App\Actions\Offer\GetOffersSeasonAction;
use App\Actions\Offer\GetOwnedOfferDetailsAction;
use App\Actions\Offer\GetOwnedOffersAction;
use App\Actions\Offer\GetRequestedOffersAction;
use App\Actions\Offer\GetUpdatedOfferAction;
use App\Actions\Offer\RequestOfferAction;
use App\Actions\Offer\UpdateOfferAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Offer\CreateOfferRequest;
use App\Http\Requests\Api\Offer\UpdateOfferRequest;
use App\Http\Resources\Api\Offer\ShortInfoOfferResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GetOffersAction $action): PaginateResource
    {

        $response = $action->execute($request);
        return new PaginateResource($response, ShortInfoOfferResource::collection($response->items()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOfferRequest $request, CreateOfferAction $action): JsonResponse
    {
        return new JsonResponse(["data" => $action->execute($request), "message" => __("offers.offer_create_successfully")]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, GetCustomerOfferDetailsAction $action): JsonResponse
    {
        /// TODO: there is an error here
        return new JsonResponse($action->execute($id));
    }
    public function offerUpteted($id, GetUpdatedOfferAction $action)
    {
        return $action->execute($id);
    }
    function edit($id, GetDetailsUpdateOfferAction $action)
    {
        return $action->execute($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, UpdateOfferAction $action, int $id): JsonResponse
    {

        return $action->execute($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, DeleteOfferAction $action): JsonResponse
    {
        $action->execute($id);
        return new JsonResponse(["message" => __("offers.offer_deleted_successfully")]);
    }


    public function getOwnedOffers(GetOwnedOffersAction $action): PaginateResource
    {
        return $action->execute();
    }

    public function getOwnedOfferDetails(int $id, GetOwnedOfferDetailsAction $action): JsonResponse
    {
        return new JsonResponse(["data" => $action->execute($id)]);
    }

    public function requestedOffers(GetRequestedOffersAction $action): PaginateResource
    {
        $response = $action->execute();
        return new PaginateResource($response, ShortInfoOfferResource::collection($response->items()));
    }

    public function requestOffer(int $id, RequestOfferAction $action): JsonResponse
    {
        $action->execute($id);
        return new JsonResponse(["message" => "offers.the_offer_requested_successfully"]);
    }
    public function offersSeason(GetOffersSeasonAction $action)
    {
        return $action->execute();
    }
    public function offersMostRequest(GetOffersMostRequestAction $action)
    {
        return $action->execute();
    }
}
