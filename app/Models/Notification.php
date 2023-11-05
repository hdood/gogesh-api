<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "title_ar",
        "content",
        "content_ar",
        "ads_id",
        "offer_id",
        "commercial_activity_id ",
        "type",
        "to",
        "receive_id",
        "type_receive",
    ];
    public function receive(): BelongsTo
    {
        return $this->belongsTo($this->type_receive, 'receive_id')->withDefault();
    }
    public function getTitle()
    {
        return App::getLocale() == "en" ? $this->title ?? $this->title_ar : $this->title_ar ?? $this->title;
    }

    public function getContent()
    {
        return App::getLocale() == "en" ? $this->content ?? $this->content_ar : $this->content_ar ?? $this->content;
    }
}
