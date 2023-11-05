<?php

namespace App\Actions\Contact\Customer;

use App\Models\Conversation;

class MakeContactCompleteAction
{
    public function __construct()
    {
    }
    public function execute($id)
    {
        $conversation = Conversation::findOrfail($id);
        $conversation->complete = 1;
        $conversation->save();
        return response()->json('the order is completed');
    }
}
