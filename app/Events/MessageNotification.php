<?php

namespace App\Events;

use App\Models\Contact;
use App\Models\Support;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public string $message;

    public function __construct(public $contact)
    {
        $this->contact = $contact;
        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastOn(): array
    {
        return ["public"];
    }

    public function broadcastAs(): string
    {
        return 'public';
    }
}
