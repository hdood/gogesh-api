<?php

namespace App\Actions\Contact\Seller;

use App\Events\MessageConversationCustomer;
use App\Events\MessageConversationSeller;
use App\Events\PusherBroadcast;
use App\Events\SupportBroadcast;
use App\Http\Resources\Api\Conversation\ContactResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\Conversation\MessageResource as ConversationMessageResource;
use App\Http\Resources\Api\Support\MessageResource;
use App\Jobs\SendNotificationCustomer;
use App\Models\Conversation;
use App\Models\Seller;
use App\Models\Support;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;

class SendMessageAction
{

    private function sendSupport(HttpRequest $request)
    {
        $request->validate([
            "contact_id" => "required|exists:supports,id",
            'message' => 'required_if:attachment,null',
            'attachment' => 'required_if:message,null',
        ]);
        if (get_class(Auth::user()) == Seller::class) {
            $userId = Auth::id();
        } else {
            $userId = Auth::user()->seller->id;
        }
        $conversation = Support::findOrfail($request->contact_id);
        $message = $conversation->messages()->create([
            'support_id' => $request->contact_id,
            'sender_id' => $userId,
            'type' => Seller::class,
            'message' => $request->message,
            'attachment' => saveImage('attachment', $request->attachment),
        ]);
        SupportBroadcast::dispatch($message);
        $conversation->update([
            'last_message' => $request->message
        ]);
        return new MessageResource($message);
    }
    private function sendConversation(HttpRequest $request)
    {
        $request->validate([
            "contact_id" => "required|exists:conversations,id",
            'message' => 'required_if:attachment,null',
            'attachment' => 'required_if:message,null',
        ]);
        $conversation = Conversation::findOrfail($request->contact_id);
        $message = $conversation->messages()->create([
            'conversation_id' => $request->contact_id,
            'sender_id' => Auth::id(),
            'type' => get_class(Auth::user()),
            'message' => $request->message,
            'attachment' => saveImage('attachment', $request->attachment),
        ]);
        PusherBroadcast::dispatch($message);
        // return $message->type .'=='. Seller::class;
        if ($message->type == Seller::class) {
            MessageConversationCustomer::dispatch($message);
        } else {
            MessageConversationSeller::dispatch($message);
        }
        $conversation->update([
            'last_message' => $request->message
        ]);
        SendNotificationCustomer::dispatch($message->sender->firstname . ' ' . $message->sender->lastname, $message->message ?? 'send image', $conversation->sender->fcm_token, ['conversation' => json_encode(new ContactResource($message->conversation))]);
        return new ConversationMessageResource($message);
    }
    public function execute(HttpRequest $request)
    {
        if (Request::query('type') == 'support') {
            $message = $this->sendSupport($request);
        } else {
            $message = $this->sendConversation($request);
        }
        return $message;
    }
}
