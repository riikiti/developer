<?php

namespace App\Http\Middleware\api\user;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBanned
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::query()->where('id', $request->header('User-Id'))->where('banned', true)->first();
        if (!empty($user)) {
            return response()->json(['msg' => 'User is blocked', 'user' => $user]);
        }
        return $next($request);
    }
}
