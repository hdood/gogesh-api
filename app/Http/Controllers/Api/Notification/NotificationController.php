<?php

namespace App\Http\Controllers\Api\Notification;

use App\Actions\Notification\Customer\GetNotificationAction;
use App\Actions\Notification\Seller\GetNotificationAction as SellerGetNotificationAction;
use App\Actions\NotificationAction;
use App\Notifications\SendPushCustomerNotification;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'haroun',
        ];
        Notification::send(null, new SendPushCustomerNotification('hello', 'hello haroun', 'fasJsdt-DUGwl0_FLaFJSu:APA91bEwBADvpHsfofjH4Qz2z8-NrNIwVr5O4ZOW8UfUeVVEL4HslX-TJ9HjVGWi5SXOqKS4GBnk_JpQ0RIDrkvXshTCtc4Hd3KLMTizzrENvu_nakL75DtuqMJBFN8HDqLS2OOZvUSd', $data));
        return 'success';
    }

    public function getToCustomer(GetNotificationAction $action)
    {
        return $action->execute();
    }

    public function getToSeller(SellerGetNotificationAction $action)
    {
        return $action->execute();
    }
}
