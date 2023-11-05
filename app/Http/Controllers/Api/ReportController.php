<?php

namespace App\Http\Controllers\Api;

use App\Actions\Report\CreateReportAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReportRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function store(CreateReportRequest $request, CreateReportAction $action): JsonResponse
    {
        $action->execute($request);
        return new JsonResponse(["message" => "reports.your_report_sent_successfully"]);
    }
    public function vedio(Request $request)
    {
        return saveImage('vedio', $request->vedio);
    }
}
