<?php

namespace App\Http\Middleware\api\favorite;


use App\Models\Favorites;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteFoundDestroy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(Favorites::query()->where('movie_id',$request->route('favorite'))->where('user_id',$request->header('User-Id')) ->first())){
            $data = [
                'status' => 404,
                'error' => 'Not Found'
            ];
            return response()->json($data, 404);
        }
        return $next($request);
    }
}
