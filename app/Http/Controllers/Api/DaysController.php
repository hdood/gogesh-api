<?php

namespace App\Http\Controllers\Api;

use App\Actions\Days\GetDaysAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DaysController extends Controller
{


    public function index(GetDaysAction $action):JsonResponse
    {
        return new JsonResponse(["data" => $action->execute()]);
    }
}
