<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function changeLocale(Request $request, $locale)
    {
        // Additional logic if needed
        session(['locale' => $locale]);
        $redirectUrl = $request->headers->get('referer') ?? route('dashboard');

        return redirect($redirectUrl);
    }
}
