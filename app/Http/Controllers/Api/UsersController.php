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
     * 
     */
    public function current()
    {
        $currentUser = Auth::user();
        
        return new UserResource($currentUser);

    }
}
