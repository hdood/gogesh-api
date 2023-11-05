<?php

namespace App\Actions\Contact\Seller;



use App\Http\Resources\PaginateResource;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Resources\Api\Conversation\ContactResource as ConversationContactResource;
use App\Http\Resources\Api\Support\ContactResource as SupportContactResource;
use App\Models\Conversation;
use App\Models\Seller;

class GetContactAction
{

    public function __construct()
    {
    }

    public function execute()
    {
        if (get_class(Auth::user()) == Seller::class) {
            $userId = Auth::id();
        } else {
            $userId = Auth::user()->seller->id;
        }
        if (Request::query('type') == 'support') {
            $contacts = Support::where('account_id', $userId)
                ->where('type', 'App\Models\Seller')->orderBy('updated_at', 'desc')->paginate(16);
            return new PaginateResource($contacts, SupportContactResource::collection($contacts));
        } else {
            $contacts = Conversation::where('receive_id', Auth::id())
                ->where('type_receive', Seller::class)
                ->whereHas('messages')
                ->orderBy('updated_at', 'desc')
                ->paginate(16);
            return new PaginateResource($contacts, ConversationContactResource::collection($contacts));
        }
    }
}
