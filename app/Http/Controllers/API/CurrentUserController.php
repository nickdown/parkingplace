<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class CurrentUserController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return new UserResource($user);
    }
}
