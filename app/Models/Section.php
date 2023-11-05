<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'service_id',
        'status',
    ];
    use HasFactory;
    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'service_id');
    }

    function getName()
    {
        return App::getLocale() == "en" ? $this->name_en : $this->name_ar;
    }
    public function comercialActivity()
    {
        return Seller::whereJsonContains('sections_id', (int)$this->id)->get();
    }
}
