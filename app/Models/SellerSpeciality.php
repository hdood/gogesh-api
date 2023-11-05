<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerSpeciality extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'speciality_id'
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }
}
