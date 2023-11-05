<?php

namespace App\Http\Controllers\Dashboard\Contact;

use App\Enum\EnumGeneral;
use App\Events\MessageNotificationCustomer;
use App\Events\MessageNotificationSeller;
use App\Events\SupportBroadcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\Api\Support\ContactResource;
use App\Jobs\SendNotificationCustomer;
use App\Jobs\SendNotificationSeller;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\Support;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Support::orderBy('updated_at', 'desc')->get();
        return view('contact.index', compact('data'));
    }

    public function getMoreContact(Request $request)
    {
        $data = Contact::whereNotNull('user_id')->orderBy('updated_at', 'desc')->paginate(10);

        return view('contact.partials.contact', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(MessageRequest $request)
    {
        $contact = Support::findOrfail($request->contact_id);
        $message = $contact->messages()->create([
            'sender_id' => Auth::id(),
            'type' => get_class(Auth::user()),
            'message' => $request->message,
            'attachment' => saveImage('attachment', $request->attachment),
        ]);
        $contact->update([
            'last_message' => $request->message,
        ]);
        SupportBroadcast::dispatch($message);
        if ($contact->type == Seller::class) {
            MessageNotificationSeller::dispatch($message);
            SendNotificationSeller::dispatch('Support', $message->message ?? 'send image', $contact->account->fcm_token, ['support' => json_encode(new ContactResource($message->support))]);
        } else {
            MessageNotificationCustomer::dispatch($message);
            SendNotificationCustomer::dispatch('Support', $message->message ?? 'send image', $contact->account->fcm_token, ['support' => json_encode(new ContactResource($message->support))]);
        }

        return view('contact.partials.broadcast', compact('message'));
    }
    function makeContact(Request $request)
    {
        if ($request->type == 'seller') {
            $type = Seller::class;
        } elseif ($request->type == 'customer') {
            $type = Customer::class;
        }
        $contact = Support::create([
            'account_id' => $request->account_id,
            'type' => $type,
        ]);
        $account = $contact->account;
        if ($type == Seller::class) {
            SendNotificationSeller::dispatch('Messages', 'You Have a new Message', $contact->account->fcm_token, ['support' => json_encode(new ContactResource($contact))]);
        } else {
            SendNotificationCustomer::dispatch('Messages', 'You Have a new Message', $contact->account->fcm_token, ['support' => json_encode(new ContactResource($contact))]);
        }
        return view('partials.receive', compact('contact', 'account'));
    }

    public function receive(Request $request)
    {
        // return $request;
        $message = $request->message;
        return view('contact.partials.receive', compact('message'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Support::findOrfail($id);
        $contact->messages()->whereNot('type', get_class(Auth::user()))->update(['status' => EnumGeneral::READ]);
        $replies = $contact->messages()->orderBy('created_at', 'desc')->paginate(10);
        $replies = $replies->reverse();
        return view('contact.partials.chat', compact('contact', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = Contact::findOrfail($id);
        $contact->status = $request->status;
        $contact->save();
        return to_route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contact::findOrfail($id)->delete();
    }
}
