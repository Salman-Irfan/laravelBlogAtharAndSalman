<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{

 public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return $next($request);
        } else {
            $user = Auth::user() && Auth::user()->hasRole('user');
            return $next($request);
        
            return response()->json([
                'message' => 'You have no right to do this',
                'user' => $user,
            ], 403);
        }
    }

}
