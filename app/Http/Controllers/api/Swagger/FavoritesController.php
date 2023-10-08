<?php

namespace App\Http\Controllers\api\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 * path="/api/favorites",
 * summary = "create record",
 * tags= {"Favorites"},
 *
 * @OA\Parameter(
 *     name="User-ID",
 *     in="header",
 *     required=true,
 *     @OA\Schema(
 *         type="integer"
 *     ),
 *     description="user-id"
 * ),*
 *
 * @OA\RequestBody(
 *      @OA\JsonContent(
 *            allOf={
 *               @OA\Schema(
 *                          @OA\Property (property="movie_id", type = "integer", example="1"),
 *                         )
 *            }
 *      )
 * ),
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *              @OA\JsonContent(
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *                          @OA\Property (property="user_id", type = "integer", example="1"),
 *                          @OA\Property (property="movie_id", type = "integer", example="1"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 * @OA\Delete (
 * path="/api/favorites/{id}",
 * summary = "delete record",
 * tags= {"Favorites"},
 *
 * @OA\Parameter(
 *     description = "id record",
 *     in = "path",
 *     name="id",
 *     required = true,
 *     example=1,
 * ),
 *
 * @OA\Parameter(
 *     name="User-ID",
 *     in="header",
 *     required=true,
 *     @OA\Schema(
 *         type="integer"
 *     ),
 *         description="user-id"
 * ),
 *
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *              @OA\JsonContent(
 *                          @OA\Property (property="status", type = "integer", example="200"),
 *                          @OA\Property (property="msg", type = "string", example="success"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 */
class FavoritesController extends Controller
{
    //
}
