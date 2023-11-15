<?php

namespace App\Http\Middleware\api\user;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('User-Id')!=$request->route('user')){
            $data = [
                'status' => 403,
                'error' => 'Forbidden'
            ];
            return response()->json($data, 403);
        }
        return $next($request);
    }
}
