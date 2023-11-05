<?php

namespace App\Models;

use App\Enum\EnumGeneral;
use App\Events\MessageNotificationCustomer;
use App\Events\MessageNotificationSeller;
use App\Http\Resources\Api\contact\ContactCustomerResource;
use App\Http\Resources\Api\contact\ContactSellerResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;
    // protected $table = 'conversations';

    protected $fillable = [
        'receive_id',
        'sender_id',
        'type_receive',
        'type_sender',
        'offer_id',
        'ads_id',
        'last_message',
        'complete'
    ];
    public function sender(): BelongsTo
    {
        return $this->belongsTo($this->type_sender, 'sender_id');
    }

    public function receive(): BelongsTo
    {
        return $this->belongsTo($this->type_receive, 'receive_id');
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ads::class, 'ads_id');
    }

    public function sendNotification($contact)
    {
        if (!empty($contact->seller_id) && !empty($contact->customer_id)) {
            MessageNotificationCustomer::dispatch(new ContactCustomerResource($contact));
            MessageNotificationSeller::dispatch(new ContactSellerResource($contact));
        } elseif (!empty($contact->seller_id)) {
            MessageNotificationCustomer::dispatch(new ContactCustomerResource($contact));
        } elseif (!empty($contact->customer_id)) {
            MessageNotificationSeller::dispatch(new ContactSellerResource($contact));
        }
    }
    public function messages(): HasMany
    {
        return $this->hasMany(MessageNew::class, 'conversation_id');
    }

    public function unreads(): HasMany
    {
        return $this->hasMany(MessageNew::class, 'conversation_id')
            ->whereNot('type', get_class(Auth::user()))
            ->where('status', EnumGeneral::UNREAD);
    }
}
