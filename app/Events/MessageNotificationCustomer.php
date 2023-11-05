<?php

namespace App\Events;

use App\Http\Resources\Api\Support\NotificationContactResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageNotificationCustomer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public string $message;
    private $channel;

    public function __construct(public $contact)
    {
        $this->contact = new NotificationContactResource($contact);
        $this->channel = "customer." . $contact->support->account_id;
        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastOn(): array
    {
        return [$this->channel];
    }

    public function broadcastAs(): string
    {
        return 'private';
    }
}
