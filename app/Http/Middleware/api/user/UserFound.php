<?php

namespace App\Http\Middleware\api\user;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserFound
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find($request->route('user'));
        if (empty($user)) {
            $data = [
                'status' => 404,
                'error' => 'Not Found'
            ];
            return response()->json($data, 404);
        }
        return $next($request);
    }
}
