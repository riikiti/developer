<?php

namespace App\Http\Controllers\api\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get (
 * path="/api/movie",
 * summary = "get all movies",
 * tags= {"Movie"},
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *             @OA\JsonContent(
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *                          @OA\Property (property="name", type = "string", example="Thor"),
 *                          @OA\Property (property="budgetInMillions", type = "integer", example="123"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 * @OA\Get (
 * path="/api/movie/{movie}",
 * summary = "get movie",
 * tags= {"Movie"},
 *
 * @OA\Parameter(
 *     description = "id",
 *     in = "path",
 *     name="movie",
 *     required = true,
 *     example=1,
 * ),
 *
 *
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *             @OA\JsonContent(
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *                          @OA\Property (property="name", type = "string", example="Thor"),
 *                          @OA\Property (property="budgetInMillions", type = "integer", example="123"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 */
class MovieController extends Controller
{
    //
}
