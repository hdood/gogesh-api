<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class SendPushCustomerNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $data;
    protected $fcmTokens;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $message, $fcmTokens = null, $data = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->data = $data;
        if ($fcmTokens == null) {
            $this->fcmTokens = "/topics/gogehs";
        } else {
            $this->fcmTokens = $fcmTokens;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $authorizationKey =  env('FIREBASE_APP_KEY_CUSTOMER');

        $headers = [
            'Authorization' => 'key=' . $authorizationKey,
            'Content-Type' => 'application/json',
        ];

        $payload = [
            'to' => $this->fcmTokens,
            "notification" => [
                "title" => $this->title,
                "body" => $this->message
            ],
            'data' => $this->data,
        ];

        $response = Http::withHeaders($headers)->post($url, $payload);

        return $response->json();
    }
}
