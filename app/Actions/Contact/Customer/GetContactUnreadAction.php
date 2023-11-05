<?php

namespace App\Actions\Contact\Customer;

use App\Enum\EnumGeneral;
use App\Models\Conversation;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Support;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetContactUnreadAction
{
    public function __construct()
    {
    }
    public function execute()
    {
        $conversation = Conversation::where('sender_id', Auth::id())
            ->whereHas('messages', function ($query) {
                $query->where('status', EnumGeneral::UNREAD)
                    ->where('type', Seller::class);
            })->count();
        $support = Support::where('account_id', Auth::id())
            ->where('type', Customer::class)
            ->whereHas('messages', function ($query) {
                $query->where('status', EnumGeneral::UNREAD)
                    ->where('type', User::class);
            })->count();
        return response()->json(['count' => $conversation + $support]);
    }
}
