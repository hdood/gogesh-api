<?php

namespace App\Actions\Contact\Customer;

use App\Events\MessageNotification;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Models\Support;
use Illuminate\Http\JsonResponse;

class MakeContactAction
{



    public function execute(ContactRequest $request)
    {
        $contact = Support::create([
            'account_id' => Auth::id(),
            'type' => get_class(Auth::user()),
            'subject' => $request->subject,
            'content' => $request->content
        ]);
        $data["contact"] = $contact;
        $data["account"] = $contact->account;
        MessageNotification::dispatch($data);
        $message = $contact->messages()->create([
            'sender_id' => Auth::id(),
            'type' => get_class(Auth::user()),
            'message' => "$request->subject / $request->content",
            'attachment' => saveImage('attachment', $request->attachment),
        ]);
        // $contact->sendNotification($contact);

        return new JsonResponse('success');

    }
}
