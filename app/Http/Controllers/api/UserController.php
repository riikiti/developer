<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function show(string $id)
    {
        if (empty($_GET['User-Id'])) {
            return response(null);
        } else {
            if ($_GET['User-Id'] == $id) {
                return User::findOrFail($id);
            } else {
                return response('error');
            }

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserStoreRequest $request, User $user)
    {
          if (empty($_GET['User-Id'])) {
              return response(null);
          } else {
              if ($_GET['User-Id']=$user['id']){
                  $user->update($request->validated());
                  return new  UserResource($user);
              }
              else{
                  return response('error');
              }

          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (empty($_GET['User-Id'])) {
            return response(null);
        } else {
            $user->delete();
            return response(null);
        }
    }
}
