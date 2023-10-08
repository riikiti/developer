<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return UserResource::collection(User::all());
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
    public function store(UserStoreRequest $request)
    {
        try {
            return User::create($request->validated());
        }catch (\Exception $exception){
            $data = [
                'status' => 500,
                'error' => 'Internal Server Error. User already created'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        try {
            $user = User::find($id);
            if (empty($user)) {
                $data = [
                    'status' => 404,
                    'error' => 'Not Found'
                ];
                return response()->json($data, 404);
            } else {
                $value = $request->header('User-Id');
                if (empty($value)) {
                    $data = [
                        'status' => 401,
                        'error' => 'Unauthorized'
                    ];
                    return response()->json($data, 401);
                } else {
                    if ($value == $id) {
                        return new UserResource($user);
                    } else {
                        $data = [
                            'status' => 403,
                            'error' => 'Forbidden'
                        ];
                        return response()->json($data, 403);
                    }

                }
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
    public function update(UserStoreRequest $request, User $user)
    {

        try {
            $value = $request->header('User-Id');
            if (empty($value)) {
                $data = [
                    'status' => 401,
                    'error' => 'Unauthorized'
                ];
                return response()->json($data, 401);
            } else {
                if ($value == $user['id']) {
                    $user->update($request->validated());
                    return new  UserResource($user);
                } else {
                    $data = [
                        'status' => 403,
                        'error' => 'Forbidden'
                    ];
                    return response()->json($data, 403);
                }

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
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {

        try {
            $user =   User::find($id);
            $value = $request->header('User-Id');

            if (empty($user)) {
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
                if ($value == $user['id']) {
                    $user->delete();
                    $data = [
                        'status' => 200,
                        'msg' => 'success'
                    ];
                    return response()->json($data);
                } else {
                    $data = [
                        'status' => 403,
                        'error' => 'Forbidden'
                    ];
                    return response()->json($data, 403);
                }
            }
        }catch (\Exception $exception){
            $data = [
                'status' => 500,
                'error' => 'Internal Server Error'
            ];
            return response()->json($data, 500);
        }


    }
}
