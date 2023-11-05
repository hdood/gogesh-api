<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'section_id'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class, "section_id");
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class, "seller_id");
    }
}
