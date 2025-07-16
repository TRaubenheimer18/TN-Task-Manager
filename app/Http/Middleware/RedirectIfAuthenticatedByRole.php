<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedByRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'member':
                    return redirect()->route('member.dashboard');
                case 'guest':
                    return redirect()->route('guest.dashboard');
            }
        }

        return $next($request);
    }
}
