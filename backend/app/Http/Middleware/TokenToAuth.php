<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenToAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');
        return response($token);
        if ($token) {
            $request->headers->set('Authorization', "Bearer $token");
        } else {
            return response([
                'message' => 'Invalid token'
            ], 401);
        }
        return $next($request);
    }
}
