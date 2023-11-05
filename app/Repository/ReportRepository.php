<?php

namespace App\Repository;

use App\Models\Report;

class ReportRepository
{


    public function create($array):Report
    {
        return Report::create($array);
    }

}
