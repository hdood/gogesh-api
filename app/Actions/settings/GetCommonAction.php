<?php

namespace App\Actions\Settings;

use App\Http\Resources\Api\Settings\CommonResource;
use App\Http\Resources\PaginateResource;
use App\Models\CommonQuestion;
use Illuminate\Support\Facades\Request;

class GetCommonAction
{
    public function __construct()
    {
    }

    public function execute()
    {
        $q = Request::query('type');
        if ($q) {
            $response = CommonQuestion::whereIn("for", [$q, "All"])->paginate(15);
        } else {
            $response = CommonQuestion::where("for", "All")->paginate(15);
        }
        // return $common;
        return  new PaginateResource($response, CommonResource::collection($response->items()));
    }
}
