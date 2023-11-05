<?php

namespace App\Providers;

use App\Mail\EmailContact;
use App\Jobs\ProcessPeriodicTask;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Mail::to("haroun200239@gmail.com")->send(new EmailContact(3333));
    }
}
