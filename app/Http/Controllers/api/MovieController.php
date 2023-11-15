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
            return MovieResource::collection(Movie::paginate($per_page));
    }

    public function show(Request $request)
    {
        return new MovieResource(Movie::find($request->route('movie')));
    }


}
