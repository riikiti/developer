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
       $per_page = $request->query('per_page');
        if (empty ($per_page)) {
            $per_page = 10;
        }
        //pagintion
        return MovieResource::collection(Movie::paginate($per_page));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'status' => 500,
            'error' => 'INTERNAL_ERROR'
        ];
        return response()->json($data, 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Movie::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'status' => 500,
            'error' => 'INTERNAL_ERROR'
        ];
        return response()->json($data, 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = [
            'status' => 500,
            'error' => 'INTERNAL_ERROR'
        ];
        return response()->json($data, 500);
    }
}
