<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Day extends Model
{
    use HasFactory;


    protected $fillable = [
      "name_ar",
      "name_en",
    ];



    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }


}
