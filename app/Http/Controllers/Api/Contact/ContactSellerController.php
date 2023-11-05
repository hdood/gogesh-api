<?php

namespace App\Http\Controllers\Api\Contact;

use App\Actions\Contact\Seller\GetContactAction;
use App\Actions\Contact\Seller\GetContactUnreadAction;
use App\Actions\Contact\Seller\GetDetailsContactAction;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\PaginateResource;
use App\Actions\Contact\Seller\MakeContactAction;
use App\Actions\Contact\Seller\SendMessageAction;
use Illuminate\Http\Request;

class ContactSellerController extends Controller
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
    public function show($id, GetDetailsContactAction $action): PaginateResource
    {
        return $action->execute($id);
    }
    function countContactUnread(GetContactUnreadAction $action)
    {
        return $action->execute();
    }
}
