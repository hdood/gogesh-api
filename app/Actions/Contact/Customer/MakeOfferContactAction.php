<?php

namespace App\Actions\Contact\Customer;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactWithSellerRequest;
use App\Http\Resources\Api\Conversation\ContactResource;
use App\Models\Conversation;
use App\Repository\Dashboard\Offer\OfferRepository;
use App\Http\Resources\Api\Conversation\ContactWithSellerResource;
use App\Jobs\SendNotificationSeller;
use App\Models\Seller;

class MakeOfferContactAction
{
    public function __construct(private OfferRepository $repository)
    {
    }

    public function execute(ContactWithSellerRequest $request)
    {
        $contact = Conversation::where('sender_id', Auth::id())->where('offer_id', $request->offer_id)
            ->first();
        if (!$contact) {
            $contact = Conversation::create([
                'sender_id' => Auth::id(),
                'type_sender' => get_class(Auth::user()),
                'receive_id' =>  $this->repository->getById($request->offer_id)->seller->id,
                'type_receive' => Seller::class,
                'offer_id' => $request->offer_id,
            ]);
            SendNotificationSeller::dispatch('Messages', 'You Have a new Message', $contact->receive->fcm_token, ['conversation' => json_encode(new ContactResource($contact))]);
        } elseif ($contact->complete == 1) {
            $contact = Conversation::create([
                'sender_id' => Auth::id(),
                'type_sender' => get_class(Auth::user()),
                'receive_id' =>  $this->repository->getById($request->offer_id)->seller->id,
                'type_receive' => Seller::class,
                'offer_id' => $request->offer_id,
            ]);
            SendNotificationSeller::dispatch('Messages', 'You Have a new Message', $contact->receive->fcm_token, ['conversation' => json_encode(new ContactResource($contact))]);
        }

        // MessageNotification::dispatch($contact->load('customer'));
        // MessageConversationSeller::dispatch($message);

        return new ContactWithSellerResource($contact);
    }
}
