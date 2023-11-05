<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurationOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'duration',
        'price',
        'type',
        'status',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class, 'duration_id');
    }
}
