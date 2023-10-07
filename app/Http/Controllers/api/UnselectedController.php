<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritesResource;
use App\Http\Resources\MovieResource;
use App\Models\Favorites;
use Illuminate\Http\Request;
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
                        ->select('movies.name', 'movies.budgetInMillions')
                        ->leftJoin('favorites', function ($join) use ($value) {
                            $join->on('movies.id', '=', 'favorites.movie_id')
                                ->where('favorites.user_id', '!=', $value);
                        })
                        ->whereNull('favorites.user_id')
                        ->get();
                    return response()->json($movies);
                case "inMemory":
                    $movie_in_favorites = Favorites::where('user_id', $value);
                    $data = [
                        'status' => 200,
                        'error' => $loaderType,
                        'movie'=>$movie_in_favorites
                    ];
                    return response()->json($data);
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
