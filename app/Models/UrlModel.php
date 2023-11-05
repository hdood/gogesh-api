<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'used'
    ];
}
