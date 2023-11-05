<?php

namespace App\Events;

use App\Http\Resources\Api\Support\MessageResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SupportBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $channel;
    public function __construct(public $message)
    {
        $this->message = new MessageResource($message);
        $this->channel = "support." . $message->support_id;
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
