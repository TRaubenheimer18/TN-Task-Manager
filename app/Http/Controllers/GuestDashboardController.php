<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestDashboardController extends Controller
{
     public function index()
    {
        
        return view('dashboards.guest');
    }
}
