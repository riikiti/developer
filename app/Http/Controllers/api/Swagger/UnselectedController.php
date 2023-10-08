<?php

namespace App\Http\Controllers\api\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Get (
 * path="/api/unselected?loaderType={type}",
 * summary = "get 1 movie",
 * tags= {"Unselected"},
 *
 * @OA\Parameter(
 *     description = "type",
 *     in = "path",
 *     name="type",
 *     required = true,
 *     example="sql",
 * ),
 * @OA\Parameter(
 *     name="User-ID",
 *     in="header",
 *     required=true,
 *     @OA\Schema(
 *         type="integer"
 *     ),
 *     description="user-id"
 * ),
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
class UnselectedController extends Controller
{
    //
}
