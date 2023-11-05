<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class NotificationAction
{
    public function __construct()
    {
    }

    public function execute($topic = null, $title, $body)
    {
        $serverKey = env('FIREBASE_APP_KEY');
        // return $serverKey;
        $response = Http::post('https://fcm.googleapis.com/fcm/send', [
            "headers" => [
                "Authorization" => "key=$serverKey",
                "Content-Type" => "application/json",
            ],
            "json" => [
                "to" =>  "/topic/ddd",
                "notification" => [
                    "title" => "dsd",
                    "body" => "sd",
                ],
            ],
        ]);
        return $response;
    }
}
