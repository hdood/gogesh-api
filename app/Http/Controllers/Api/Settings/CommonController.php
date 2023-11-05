<?php

namespace App\Http\Controllers\Api\Settings;

use App\Actions\Settings\GetCommonAction;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{


    public function index(GetCommonAction $action)
    {
        return  $action->execute();
    }
}
