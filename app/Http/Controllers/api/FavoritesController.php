<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavoritesStoreRequest;
use App\Http\Resources\FavoritesResource;
use App\Models\Favorites;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FavoritesResource::collection(Favorites::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoritesStoreRequest $request)
    {
        $value = $request->header('User-Id');
        $existingRecord = Favorites::where('user_id', $value)
            ->where('movie_id', $request->input('movie_id'))
            ->first();
        if (empty($existingRecord)){
            if (empty($value)) {
                $data = [
                    'status' => 401,
                    'error' => 'Unauthorized'
                ];
                return response()->json($data, 401);
            } else {
                $favorites=new Favorites;
                $favorites->user_id=$value;
                $favorites->movie_id=$request->movie_id;
                $favorites->save();
                return response()->json($favorites, 200);
            }
        }
        else{
            $data = [
                'status' => 409,
                'error' => 'Conflict'
            ];
            return response()->json($data, 409);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //ne bydet
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
//todo сделать 2 invoke контроллера которые будут выводить из памяти и из кеша по разным эндпоинтам
