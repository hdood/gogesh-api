<?php

namespace App\Providers;

use App\Enum\EnumGeneral;
use App\Models\Contact;
use App\Models\Support;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderProvider extends ServiceProvider
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
        // $contacts = Support::whereHas('messages', function ($q) {
        //     $q->whereNot('type', User::class)->where('status', EnumGeneral::UNREAD);
        // })->orderBy('created_at', 'desc')->get();
        // View::share('new_contacts', $contacts);
    }
}
