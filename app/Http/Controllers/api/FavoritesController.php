<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavoritesStoreRequest;
use App\Http\Resources\FavoritesResource;
use App\Models\Favorites;
use App\Models\Movie;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index()
    {
        return FavoritesResource::collection(Favorites::all());
    }
    public function store(FavoritesStoreRequest $request)
    {
        $favorites = new Favorites;
        $favorites->user_id = $request->header('User-Id');
        $favorites->movie_id = $request->movie_id;
        $favorites->save();
        return response()->json($favorites, 200);
    }
    public function destroy(Request $request)
    {
        $user = Favorites::query()->where('movie_id',$request->route('favorite'))->where('user_id',$request->header('User-Id')) ->first();
        $user->delete();
        $data = [
            'status' => 200,
            'msg' => 'success'
        ];
        return response()->json($data);
    }
}
