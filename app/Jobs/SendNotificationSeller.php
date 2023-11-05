<?php

namespace App\Jobs;

use App\Mail\EmailContact;
use App\Notifications\SendPushSellerNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Notification;

class SendNotificationSeller implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $title;
    private $body;
    private $fcm_token;
    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct($title, $body, $fcm_token = null, $data = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->fcm_token = $fcm_token;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send(null, new SendPushSellerNotification($this->title, $this->body, $this->fcm_token, $this->data));
    }
}
