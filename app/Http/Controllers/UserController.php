<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
