<?php

namespace App\Http\Controllers\api\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 * path="/api/users",
 * summary = "create user",
 * tags= {"Users"},
 *
 *
 * @OA\RequestBody(
 *      @OA\JsonContent(
 *            allOf={
 *               @OA\Schema(
 *                          @OA\Property (property="email", type = "string", example="123@gamil.com"),
 *                          @OA\Property (property="username", type = "string", example="123Ivan123"),
 *                          @OA\Property (property="name", type = "string", example="Ivan"),
 *                          @OA\Property (property="password", type = "string", example="123123"),
 *                         )
 *            }
 *      )
 * ),
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *              @OA\JsonContent(
 *                          @OA\Property (property="email", type = "string", example="123@gamil.com"),
 *                          @OA\Property (property="username", type = "string", example="123Ivan123"),
 *                          @OA\Property (property="name", type = "string", example="Ivan"),
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 * @OA\Get (
 * path="/api/users",
 * summary = "get users",
 * tags= {"Users"},
 *
 *
 *
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *             @OA\JsonContent(
 *                          @OA\Property (property="email", type = "string", example="123@gamil.com"),
 *                          @OA\Property (property="username", type = "string", example="123Ivan123"),
 *                          @OA\Property (property="name", type = "string", example="Ivan"),
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 * @OA\Get (
 * path="/api/users/{user}",
 * summary = "get 1 users",
 * tags= {"Users"},
 *
 * @OA\Parameter(
 *     description = "id",
 *     in = "path",
 *     name="user",
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
 *     description="user-id"
 * ),
 *
 * @OA\Response(
 * response = 200,
 * description = "Ok",
 *             @OA\JsonContent(
 *                          @OA\Property (property="email", type = "string", example="123@gamil.com"),
 *                          @OA\Property (property="username", type = "string", example="123Ivan123"),
 *                          @OA\Property (property="name", type = "string", example="Ivan"),
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *
 *              ),
 *
 * ),
 *
 * ),
 *
 *
 * @OA\Patch (
 * path="/api/users/{user}",
 * summary = "update",
 * tags= {"Users"},
 *
 * @OA\Parameter(
 *     description = "id",
 *     in = "path",
 *     name="user",
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
 *             @OA\JsonContent(
 *                          @OA\Property (property="email", type = "string", example="123@gamil.com"),
 *                          @OA\Property (property="username", type = "string", example="123Ivan123"),
 *                          @OA\Property (property="name", type = "string", example="Ivan"),
 *                          @OA\Property (property="id", type = "integer", example="1"),
 *
 *              ),
 *
 * ),
 * @OA\RequestBody(
 *      @OA\JsonContent(
 *            allOf={
 *               @OA\Schema(
 *                          @OA\Property (property="email", type = "string", example="123@gamil.com"),
 *                          @OA\Property (property="username", type = "string", example="123Ivan123"),
 *                          @OA\Property (property="name", type = "string", example="Ivan"),
 *                          @OA\Property (property="password", type = "string", example="123123"),
 *                         )
 *            }
 *      )
 * ),
 *
 * ),
 *
 *
 * @OA\Delete (
 * path="/api/users/{user}",
 * summary = "delete user",
 * tags= {"Users"},
 *
 * @OA\Parameter(
 *     description = "id",
 *     in = "path",
 *     name="user",
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
 *             @OA\JsonContent(
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
class UserController extends Controller
{
    //
}
