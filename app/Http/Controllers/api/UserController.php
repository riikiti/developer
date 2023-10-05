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
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $value = $request->header('User-Id', 0);
        if (empty($value)) {
            return response($value);
        } else {
            if ($value == $id) {
                return User::findOrFail($id);
            } else {
                $data = [
                    'status' => 500,
                    'error' => 'INTERNAL_ERROR'
                ];
                return response()->json($data, 500);

            }

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user)
    {
        $value = $request->header('User-Id', 0);
        if (empty($value)) {
            return response(null);
        } else {
            if ($value == $user['id']) {
                $user->update($request->validated());
                return new  UserResource($user);
            } else {
                $data = [
                    'status' => 500,
                    'error' => 'INTERNAL_ERROR'
                ];
                return response()->json($data, 500);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Request $request)
    {
        $value = $request->header('User-Id', 0);
        if (empty($value)) {
            $data = [
                'status' => 500,
                'error' => 'INTERNAL_ERROR'
            ];
            return response()->json($data, 500);
        } else {
            $user->delete();
            $data = [
                'msg' => 'success'
            ];
            return response()->json($data, 200);
        }
    }
}
