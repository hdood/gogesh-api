<?php

namespace App\Actions\Contact\Customer;

use App\Http\Resources\PaginateResource;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\Api\Conversation\ContactResource as ConversationContactResource;
use App\Http\Resources\Api\Support\ContactResource as SupportContactResource;
use App\Models\Conversation;
use App\Models\Customer;

class GetContactAction
{

    public function __construct()
    {
    }

    public function execute()
    {
        if (Request::query('type') == 'support') {
            $contacts = Support::where('account_id', Auth::id())
                ->where('type', 'App\Models\Customer')->orderBy('updated_at', 'desc')->paginate(16);
            return new PaginateResource($contacts, SupportContactResource::collection($contacts));
        } else {
            $contacts = Conversation::where('sender_id', Auth::id())
                ->where('type_sender', Customer::class)
                ->whereHas('messages')
                ->orderBy('updated_at', 'desc')
                ->paginate(16);

            return new PaginateResource($contacts, ConversationContactResource::collection($contacts));
        }
    }
}
