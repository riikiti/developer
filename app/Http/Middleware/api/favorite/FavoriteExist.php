<?php

namespace App\Http\Middleware\api\favorite;

use App\Models\Favorites;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $existingRecord = Favorites::where('user_id', $request->header('User-Id'))
            ->where('movie_id', $request->input('movie_id'))
            ->first();
        if (!empty($existingRecord)) {
            $data = [
                'status' => 409,
                'error' => 'Conflict'
            ];
            return response()->json($data, 409);
        }
        return $next($request);
    }
}
