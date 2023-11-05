<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetCodePassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
    ];

    public function isExpire()
    {
        if ($this->created_at > now()->addHour()) {
            return true;
        }
        return  false;
    }
}


