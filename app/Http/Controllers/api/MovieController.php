<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        try {
            $per_page = $request->query('per_page');
            if (empty ($per_page)) {
                $per_page = 10;
            }
            return MovieResource::collection(Movie::paginate($per_page));
        }catch (\Exception $exception){
            $data = [
                'status' => 500,
                'error' => 'Internal Server Error'
            ];
            return response()->json($data, 500);
        }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'status' => 501,
            'error' => 'Not Implemented'
        ];
        return response()->json($data, 501);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $movie = Movie::find($id);
            if (empty($movie)) {
                $data = [
                    'status' => 404,
                    'error' => 'Not Found'
                ];
                return response()->json($data, 404);
            } else {
                return new MovieResource($movie);
            }
        }catch (\Exception $exception){
            $data = [
                'status' => 500,
                'error' => 'Internal Server Error'
            ];
            return response()->json($data, 500);
        }
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
    public function destroy(string $id)
    {
        $data = [
            'status' => 501,
            'error' => 'Not Implemented'
        ];
        return response()->json($data, 501);
    }
}
