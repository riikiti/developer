<?php

namespace App\Services\Unselected;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UnselectedService implements Unselected
{

    public function getFromSql($value): \Illuminate\Http\JsonResponse
    {
        $movies = DB::table('movies')
            ->select('movies.name', 'movies.budgetInMillions', 'movies.id')
            ->leftJoin('favorites', function ($join) use ($value) {
                $join->on('movies.id', '=', 'favorites.movie_id')
                    ->where('favorites.user_id', '=', $value);
            })
            ->whereNull('favorites.movie_id')
            ->get();
        return response()->json($movies);
    }

    public function getFromMemory($value): \Illuminate\Http\JsonResponse
    {
        $movies = Cache::remember('all_movies', 60 * 60 * 24, function () {
            return DB::table('movies')->select('movies.name', 'movies.budgetInMillions', 'movies.id')->get();
        });
        $userFavorites = Cache::remember('user_favorites' . $value, 60 * 60 * 24, function () use ($value) {
            return DB::table('favorites')
                ->where('favorites.user_id', '=', $value)
                ->select('favorites.movie_id')
                ->get()
                ->pluck('movie_id');
        });
        $notFavoritedMovies = $movies->whereNotIn('id', $userFavorites);
        return response()->json($notFavoritedMovies);
    }
}
