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
        if (empty($existingRecord)) {
            if (empty($value)) {
                $data = [
                    'status' => 401,
                    'error' => 'Unauthorized'
                ];
                return response()->json($data, 401);
            } else {
                $favorites = new Favorites;
                $favorites->user_id = $value;
                $favorites->movie_id = $request->movie_id;
                $favorites->save();
                return response()->json($favorites, 200);
            }
        } else {
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
        $data = [
            'status' => 501,
            'error' => 'Not Implemented'
        ];
        return response()->json($data, 501);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'status' => 501,
            'error' => 'Not Implemented'
        ];
        return response()->json($data, 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        $favorites =   Favorites::find($id);
        $value = $request->header('User-Id');

        if (empty($favorites)) {
            $data = [
                'status' => 404,
                'error' => 'Not Found'
            ];
            return response()->json($data, 404);
        }

        if (empty($value)) {
            $data = [
                'status' => 401,
                'error' => 'Unauthorized'
            ];
            return response()->json($data, 401);
        } else {
            if ($value == $favorites['user_id']) {
                $favorites->delete();
                $data = [
                    'status' => 200,
                    'msg' => 'success'
                ];
                return response()->json($data);
            } else {
                $data = [
                    'status' => 403,
                    'error' => 'Forbidden',
                ];
                return response()->json($data, 403);
            }
        }
    }

}
//todo сделать вывод добавленных в избранное у пользователя и не добавденных у пользователся двумя эндпоинтами(invoke controller), не избраные берутся из кеша и из запроса

/*
  $record = Favorites::find($request->query());
        if (empty($record)) {
            $data = [
                'status' => 404,
                'error' => 'Not Found'
            ];
            return response()->json($data, 404);
        }
 * */
