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
    public function index()
    {
        return UserResource::collection(User::query()->get()->all());
    }

    public function store(UserStoreRequest $request)
    {
        return User::create($request->validated());
    }

    public function show(Request $request)
    {
        $user = User::query()->where('id',$request->route('user'))->first();
        return new UserResource($user);

    }

    public function update(UserStoreRequest $request, User $user)
    {
        $user->update($request->validated());
        return new  UserResource($user);
    }

    public function destroy(Request $request)
    {
        $user = User::query()->where('id',$request->route('user'))->first();
        $user->delete();
        $data = [
            'status' => 200,
            'msg' => 'success'
        ];
        return response()->json($data);
    }
}
