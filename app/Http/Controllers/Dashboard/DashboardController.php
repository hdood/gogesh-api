<?php

namespace App\Http\Controllers\Dashboard;

use stdClass;
use App\Models\User;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = count(User::all());
        $sellers = count(Seller::all());
        $customers = count(Customer::all());
        return view('dashboard.index', compact('users', 'sellers', 'customers'));
    }

    public function receive(Request $request)
    {
        $array = $request->contact;
        $contact = new stdClass();
        foreach ($array['contact'] as $key => $value) {
            $contact->$key = $value;
        }
        $account = new stdClass();
        foreach ($array['account'] as $key => $value) {
            $account->$key = $value;
        }
        return view('partials.receive', compact('contact', 'account'));
    }
}
