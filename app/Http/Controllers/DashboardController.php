<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Checkout;

class DashboardController extends Controller
{
    public function view()
    {
        $checkout = Checkout::with('Camp')->whereUserId(Auth::id())->get();
        // return $checkout;
        return view('dashboard.dashboard', [
            'checkout' => $checkout
        ]);
    }
}
