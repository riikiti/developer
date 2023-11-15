<?php

namespace App\Http\Middleware\api\movie;

use App\Models\Movie;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieFound
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $movie = Movie::find($request->route('movie'));
        if (empty($movie)) {
            $data = [
                'status' => 404,
                'error' => 'Not Found'
            ];
            return response()->json($data, 404);
        }
        return $next($request);
    }
}
