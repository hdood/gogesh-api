<?php

namespace App\Actions\Report;


use App\Http\Requests\CreateReportRequest;
use App\Repository\ReportRepository;

class CreateReportAction
{

    public function __construct(private readonly ReportRepository $repository)
    {
    }

    public function execute(CreateReportRequest $request): void
    {
       $this->repository->create($request->validated());
    }

}
