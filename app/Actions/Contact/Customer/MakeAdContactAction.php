<?php

namespace App\Actions\Contact\Customer;


use App\Http\Requests\ContactWithAdsSellerRequest;
use App\Http\Resources\Api\Conversation\ContactResource;
use App\Http\Resources\Api\Conversation\ContactWithSellerResource;
use App\Jobs\SendNotificationSeller;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Seller;
use App\Repository\Dashboard\Ads\AdsRepository;

class MakeAdContactAction
{

    public function __construct(private AdsRepository $repository)
    {
    }

    public function execute(ContactWithAdsSellerRequest $request)
    {
        $contact = Conversation::where('sender_id', Auth::id())->where('ads_id', $request->ads_id)
            ->first();
        if (!$contact) {
            $contact = Conversation::create([
                'sender_id' => Auth::id(),
                'type_sender' => get_class(Auth::user()),
                'receive_id' =>  $this->repository->getById($request->ads_id)->seller->id,
                'type_receive' => Seller::class,
                'ads_id' => $request->ads_id,
            ]);
            SendNotificationSeller::dispatch('Messages', 'You Have a new Message', $contact->receive->fcm_token, ['conversation' => json_encode(new ContactResource($contact))]);
        } elseif ($contact->complete == 1) {
            $contact = Conversation::create([
                'sender_id' => Auth::id(),
                'type_sender' => get_class(Auth::user()),
                'receive_id' =>  $this->repository->getById($request->ads_id)->seller->id,
                'type_receive' => Seller::class,
                'ads_id' => $request->ads_id,
            ]);
            SendNotificationSeller::dispatch('Messages', 'You Have a new Message', $contact->receive->fcm_token, ['conversation' => json_encode(new ContactResource($contact))]);
        }


        // MessageNotification::dispatch($contact->load('customer'));
        // $contact->sendNotification($contact);

        return new ContactWithSellerResource($contact);
    }
}
