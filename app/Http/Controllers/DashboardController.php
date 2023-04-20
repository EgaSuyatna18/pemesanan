<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Customer;
use App\Models\Transportir;

class DashboardController extends Controller
{
    function index() {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'user' => User::get()->count(), 
            'produk' => Produk::get()->count(), 
            'customer' => Customer::get()->count(), 
            'transportir' => Transportir::get()->count() 
        ]);
    }
}
