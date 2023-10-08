<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritesResource;
use App\Http\Resources\MovieResource;
use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class UnselectedController extends Controller
{
    public function __invoke(Request $request)
    {
        $loaderType = $request->query('loaderType');
        $value = $request->header('User-Id');
        if (empty($value)) {
            $data = [
                'status' => 401,
                'error' => 'Unauthorized'
            ];
            return response()->json($data, 401);
        } else {
            switch ($loaderType) {
                case "sql":
                    //$movie_in_favorites = FavoritesResource::collection(Favorites::all()->where('user_id', "=",$value));
                    $movies = DB::table('movies')
                        ->select('movies.name', 'movies.budgetInMillions','movies.id')
                        ->leftJoin('favorites', function ($join) use ($value) {
                            $join->on('movies.id', '=', 'favorites.movie_id')
                                ->where('favorites.user_id', '=', $value);
                        })
                        ->whereNull('favorites.movie_id')
                        ->get();
                    return response()->json($movies);
                case "inMemory":
                    $movies = Cache::remember('all_movies', 60*60*24, function () {
                        return DB::table('movies')->select('movies.name', 'movies.budgetInMillions', 'movies.id')->get();
                    });
                    $userFavorites = Cache::remember('user_favorites'.$value, 60*60*24, function () use ($value) {
                        return DB::table('favorites')
                            ->where('favorites.user_id', '=', $value)
                            ->select('favorites.movie_id')
                            ->get()
                            ->pluck('movie_id');
                    });
                    $notFavoritedMovies = $movies->whereNotIn('id', $userFavorites);
                    return response()->json($notFavoritedMovies);
                default:
                    $data = [
                        'status' => 501,
                        'error' => 'Not Implemented'
                    ];
                    return response()->json($data, 501);
            }
        }
    }
}
