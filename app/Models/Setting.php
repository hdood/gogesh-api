<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Setting extends Model
{
    use HasFactory;

   protected $fillable = [
       'value',
       'value_ar',
       "key"
   ];
    public function getValue()
    {
        return App::getLocale() == "en" ? $this->value ?? $this->value_ar : $this->value_ar ?? $this->value;
    }
}
