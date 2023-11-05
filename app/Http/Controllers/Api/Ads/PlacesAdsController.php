<?php

namespace App\Http\Controllers\Api\Ads;

use Illuminate\Http\Request;
use App\Actions\Ads\GetPlacesAdsAction;
use App\Http\Controllers\Controller;

class PlacesAdsController extends Controller
{

    public function index(GetPlacesAdsAction $action)
    {
        return $action->execute();
    }
}
