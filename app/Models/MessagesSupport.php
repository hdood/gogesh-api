<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessagesSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'attachment',
        'sender_id',
        'type',
        'support_id',
        'status',

    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo($this->type, 'sender_id');
    }

    public function support(): BelongsTo
    {
        return $this->belongsTo(Support::class, 'support_id');
    }
}
