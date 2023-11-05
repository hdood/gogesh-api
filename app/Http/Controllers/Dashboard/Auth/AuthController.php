<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\SellerLoginRequest;
use App\Http\Requests\Dashboard\Auth\UserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return to_route('dashboard');
        }
        return view('auth.login');
    }

    public function login(UserRequest $request)
    {
        if (Auth::attempt($request->except('_token'))) {
            return to_route('dashboard');
        }
        return to_route('page.login');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('page.login');
    }
}
