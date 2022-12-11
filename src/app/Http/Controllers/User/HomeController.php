<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class HomeController extends Controller
{
    public function index(){
        $user = Customer::with('user')
                        ->where('user_id', auth()->user()->id)
                        ->first();
        return view('pages.dashboard.index', compact('user'));
    }
}
