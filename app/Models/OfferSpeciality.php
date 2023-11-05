<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferSpeciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'speciality_id'
    ];
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }
}
