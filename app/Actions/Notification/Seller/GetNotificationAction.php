<?php

namespace App\Actions\Notification\Seller;

use App\Http\Resources\Api\Notification\NotificationResources;
use App\Http\Resources\PaginateResource;
use App\Models\Notification;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class GetNotificationAction
{

    public function execute()
    {
        $mergedData = Notification::whereIn('to', ['seller', 'all'])
            ->orWhere(function ($query) {
                $query->where('receive_id', Auth::id())->where('type_receive', Seller::class);
            })
            ->orderByDesc('created_at')
            ->paginate(16);
        return new PaginateResource($mergedData, NotificationResources::collection($mergedData));
    }
}
