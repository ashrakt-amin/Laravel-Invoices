<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveUser
{
    public function handle(Request $request, Closure $next)
    {
        $status = Auth::user()->status;
        if ($status !== "active") {
            return response()->json('Your account is blacklisted by admin'); 

        }
        return $next($request);

   }
}
