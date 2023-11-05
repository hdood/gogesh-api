<?php

namespace App\Events;

use App\Http\Resources\Api\Conversation\MessageResource;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $channel;

    public function __construct(public $message)
    {
        $this->message = new MessageResource($message);
        $this->channel = "chat." . $message->conversation_id;

        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastOn(): array
    {
        return [$this->channel];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
