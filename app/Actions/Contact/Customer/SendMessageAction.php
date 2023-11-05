<?php

namespace App\Actions\Contact\Customer;

use App\Events\MessageConversationCustomer;
use App\Events\MessageConversationSeller;
use App\Events\PusherBroadcast;
use App\Events\SupportBroadcast;
use App\Http\Resources\Api\Conversation\ContactResource;
use App\Http\Resources\Api\Conversation\MessageResource;
use App\Http\Resources\Api\Support\MessageResource as SupportMessageResource;
use App\Jobs\SendNotificationSeller;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Support;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

class SendMessageAction
{

    public function __construct()
    {
    }
    private function sendSupport(HttpRequest $request)
    {
        $request->validate([
            "contact_id" => "required|exists:supports,id",
            'message' => 'required_if:attachment,null',
            'attachment' => 'required_if:message,null',
        ]);
        $conversation = Support::findOrfail($request->contact_id);
        $message = $conversation->messages()->create([
            'support_id' => $request->contact_id,
            'sender_id' => Auth::id(),
            'type' => get_class(Auth::user()),
            'message' => $request->message,
            'attachment' => saveImage('attachment', $request->attachment),
        ]);
        SupportBroadcast::dispatch($message);
        $conversation->update([
            'last_message' => $request->message
        ]);
        return new SupportMessageResource($message);
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
        // return $message->type == Seller::class;
        if ($message->type == Seller::class) {
            MessageConversationCustomer::dispatch($message);
        } else {
            MessageConversationSeller::dispatch($message);
        }
        SendNotificationSeller::dispatch($message->sender->firstname . ' ' . $message->sender->lastname, $message->message ?? 'send image', $conversation->receive->fcm_token, ['conversation' => json_encode(new ContactResource($message->conversation))]);

        $conversation->update([
            'last_message' => $request->message
        ]);

        return new MessageResource($message);
    }
    public function execute(HttpRequest $request)
    {
        if (Request::query('type') == 'support') {
            $message = $this->sendSupport($request);
        } else {
            $message = $this->sendConversation($request);
        }
        return response()->json($message);
    }
}
