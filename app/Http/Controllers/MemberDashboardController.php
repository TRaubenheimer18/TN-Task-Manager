<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
     public function index()
    {
        // Pass any data you want for admin dashboard here
        return view('dashboards.member');
    }
}
