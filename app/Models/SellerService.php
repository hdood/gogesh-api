<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerService extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}
