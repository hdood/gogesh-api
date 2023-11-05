<?php

namespace App\Http\Controllers\Api;

use App\Actions\PrivacyPolicy\GetPrivacyPolicyAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivacyPolicyController extends Controller
{


    public function index(GetPrivacyPolicyAction $action)
    {
        return new JsonResponse(["data" => $action->execute()]);
    }
}
