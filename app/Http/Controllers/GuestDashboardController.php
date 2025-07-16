<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestDashboardController extends Controller
{
     public function index()
    {
        // Pass any data you want for admin dashboard here
        return view('dashboards.guest');
    }
}
