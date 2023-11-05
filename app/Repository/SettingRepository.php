<?php

namespace App\Repository;

use App\Enum\EnumGeneral;
use App\Models\Setting;

class SettingRepository
{


    public function getByKey(string $key)
    {
       return Setting::where("key",$key)->first();
    }
}
