<?php

namespace App\Actions\Contact\Seller;

use App\Enum\EnumGeneral;
use App\Models\Conversation;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class GetContactUnreadAction
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
        $conversation = Conversation::where('receive_id', $userId)
            ->whereHas('messages', function ($query) {
                $query->where('status', EnumGeneral::UNREAD)
                    ->where('type', Customer::class);
            })->count();
        $support = Support::where('account_id', $userId)
            ->where('type', Seller::class)
            ->whereHas('messages', function ($query) {
                $query->where('status', EnumGeneral::UNREAD)
                    ->where('type', User::class);
            })->count();
        return response()->json(['count' => $conversation + $support]);
    }
}
