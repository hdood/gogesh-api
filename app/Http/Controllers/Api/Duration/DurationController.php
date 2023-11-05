<?php

namespace App\Http\Controllers\Api\Duration;

use App\Actions\Duration\GetDurationAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DurationController extends Controller
{
    public function index(GetDurationAction $action): JsonResponse
    {
        $response = $action->execute();
        return new JsonResponse(["data" => $response]);
    }
}
