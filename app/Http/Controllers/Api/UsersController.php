<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     *
     * @return \App\Models\User
    */
    public function current()
    {
        
        $currentUser = Auth::user();
        
        Log::debug("[UsersController - currentUser]: ".$currentUser);

        return new UserResource($currentUser);

    }
}
