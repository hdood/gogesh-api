<?php

namespace App\Http\Controllers\Api\Contact;

use App\Actions\Contact\Customer\GetContactAction;
use App\Actions\Contact\Customer\GetContactUnreadAction;
use App\Actions\Contact\Customer\GetDetailsContactAction;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\MessageRequest;

use App\Http\Requests\ContactWithSellerRequest;

use App\Actions\Contact\Customer\MakeContactAction;
use App\Actions\Contact\Customer\MakeAdContactAction;
use App\Actions\Contact\Customer\MakeContactCompleteAction;
use App\Actions\Contact\Customer\SendMessageAction;
use App\Actions\Contact\Customer\MakeOfferContactAction;
use App\Http\Requests\ContactWithAdsSellerRequest;
use Illuminate\Http\Request;

class ContactCustomerController extends Controller
{

    public function index(GetContactAction $action)
    {
        return $action->execute();
    }
    public function store(Request $request, SendMessageAction $action)
    {

        return $action->execute($request);
    }

    public function makeContact(ContactRequest $request, MakeContactAction $action)
    {
        return $action->execute($request);
    }

    public function makeContactWithSeller(ContactWithSellerRequest $request, MakeOfferContactAction $action)
    {
        return $action->execute($request);
    }

    public function makeContactWithAdsSeller(ContactWithAdsSellerRequest $request, MakeAdContactAction $action)
    {
        return $action->execute($request);
    }
    public function show($id, GetDetailsContactAction $action)
    {
        return $action->execute($id);
    }
    public function completedContact($id, MakeContactCompleteAction $action)
    {
        return $action->execute($id);
    }
    function countContactUnread(GetContactUnreadAction $action)
    {
        return $action->execute();
    }
}
