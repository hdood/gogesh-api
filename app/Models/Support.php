<?php

namespace App\Models;

use App\Enum\EnumGeneral;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Support extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'type',
        'subject',
        'content',
        'last_message'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo($this->type, 'account_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(MessagesSupport::class, 'support_id');
    }

    public function unreads(): HasMany
    {
        return $this->hasMany(MessagesSupport::class, 'support_id')
            ->whereNot('type', get_class(Auth::user()))
            ->where('status', EnumGeneral::UNREAD);
    }
}
