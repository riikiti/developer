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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FavoritesStoreRequest $request)
    {

        $value = $request->header('User-Id', 0);

        if (empty($value)) {
            $data = [
                'status' => 401,
                'error' => 'Unauthorized'
            ];
            return response()->json($data, 401);
        } else {
            if ($value == $request['user_id']) {
                return Favorites::create($request->validated());
            } else {
                $data = [
                    'status' => 403,
                    'error' => 'Forbidden'
                ];
                return response()->json($data, 403);
            }

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
