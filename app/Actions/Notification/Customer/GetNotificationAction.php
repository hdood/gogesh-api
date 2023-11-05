<?php

namespace App\Actions\Notification\Customer;

use App\Http\Resources\Api\Notification\NotificationResources;
use App\Http\Resources\PaginateResource;
use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class GetNotificationAction
{

    public function execute()
    {
        $mergedData = Notification::whereIn('to', ['customer', 'all'])
            ->orWhere(function ($query) {
                $query->where('receive_id', Auth::id())->where('type_receive', Customer::class);
            })
            ->orderByDesc('created_at')
            ->paginate(16);
        return new PaginateResource($mergedData, NotificationResources::collection($mergedData));
    }
}
