<?php

namespace App\Http\Middleware\api\user;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAutorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty($request->header('User-Id'))){
            return response($data = [
                'status' => 401,
                'error' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
