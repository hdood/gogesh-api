<?php

namespace App\Events;

use App\Http\Resources\Api\Conversation\NotificationContactResource;
use App\Models\Contact;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageConversationSeller implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public string $message;
    private $channel;

    public function __construct(public $contact)
    {
        $this->contact = new NotificationContactResource($contact);
        $this->channel = "seller." . $contact->conversation->receive_id;
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
