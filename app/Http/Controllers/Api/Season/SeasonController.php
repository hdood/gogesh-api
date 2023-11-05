<?php

namespace App\Http\Controllers\Api\Season;

use App\Actions\Season\GetSeasonByIdAction;
use App\Actions\Season\GetSeasonsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(GetSeasonsAction $action)
    {
        return $action->execute();
    }

    public function show(int $id,GetSeasonByIdAction $action):JsonResponse
    {
        return new JsonResponse(["data" => $action->execute($id)]);
    }
}
