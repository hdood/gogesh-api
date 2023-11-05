<?php

namespace App\Actions\Contact\Customer;

use App\Enum\EnumGeneral;

use App\Http\Resources\PaginateResource;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Http\Resources\Api\Conversation\DetailsContactResource;
use App\Http\Resources\Api\Support\DetailsContactResource as SupportDetailsContactResource;

class GetDetailsContactAction
{

    public function __construct()
    {
    }

    public function execute($id)
    {
        if (FacadesRequest::query('type') == 'support') {
            $contact = Support::findOrfail($id);
            $contact->messages()->whereNot('type', get_class(Auth::user()))->update(['status' => EnumGeneral::READ]);
            $messages = $contact->messages()->orderBy('created_at', 'desc')->paginate(16);
            // return $messages;
            return new PaginateResource($messages, SupportDetailsContactResource::collection($messages));
        } else {
            $contact = Conversation::findOrfail($id);
            $contact->messages()->whereNot('type', get_class(Auth::user()))->update(['status' => EnumGeneral::READ]);
            $messages = $contact->messages()->orderBy('created_at', 'desc')->paginate(16);
            return new PaginateResource($messages, DetailsContactResource::collection($messages));
        }
    }
}
