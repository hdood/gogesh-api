<?php

namespace App\Repository\Day;

use App\Models\Day;
use Illuminate\Database\Eloquent\Collection;

class DaysRepository
{

    public function getDays(): Collection
    {
        return Day::all();
    }

}
