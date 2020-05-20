<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * register method
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        // check if email is in use
        $user = User::where('email', $request->email)->first();
        if ($user) 
        {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'This email is already registered, please login.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $verifyUser = User::where('email', $user->email)->first();

        if ($verifyUser) {
            return response()->json([
                'user' => $user,
                'message' => "{$user->name} successfully created.",
                'status' => Response::HTTP_CREATED,
            ], Response::HTTP_CREATED);
        }

        return response()->json([
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'This email is not registered, please register'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * login method
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        
        // check if user exists
        $user = User::where('email', $request->email)->first();
<<<<<<< HEAD
=======
        Log::debug('[AuthController]-> user check: ' . $user);
>>>>>>> 474e717128508e1e781515421cc4721217c93f7f
        
        // if there is no user with that email, respond in kind
        if (!$user)                  
        {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'This email is not registered, please register'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // if password doesn't match, no soup for you
        if (!Hash::check(request('password'), $user->password)) {

            return response()->json()([
                'message' => 'Incorrect email or password',
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
            
        }

        // gather data to get access_token which allows user to login
        // note that Oauth is expecting username
        $data = [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ];

        // Get access_token
        $request = Request::create('/oauth/token', 'POST', $data);
            
        // 
        $response = app()->handle($request);

        if ($response->getStatusCode() != 200) {

            return response()->json([
                'message' => 'Incorrect email or password - maybe both, or at least one(1).',
                'status' => $response->getStatusCode(),
            ], $response->getStatusCode());
        }
        // unpack the response
        $responseData = json_decode($response->getContent());

        // log the user in
        Auth::login($user);

        // set user var
        $user = Auth::User();

        // set the token cookie
        $token_cookie = cookie('tokenCookie', $responseData->access_token);

        // set the user cookie
        $user_cookie = cookie('userCookie', $user);

        // queue the cookies...  Heeeeere's the cookies!
        Cookie::queue($token_cookie);
        Cookie::queue($user_cookie);

        // return a JSON response
        return response()->json([
            'user' => $user,
            'token' => $responseData->access_token,
            'expires_in' => $responseData->expires_in,
            'message' => "{$user->name} successfully logged in.",
            'status' => Response::HTTP_OK,
        ]);
    }

    public function logout()
    {
        if (Auth::user()) {

            // fetch user's ID
            $accessToken = Auth::user()->token()->id;
            $currentId = DB::table('oauth_access_tokens')->where('id', $accessToken)->first()->user_id;

            // if logged in, delete access token
            if ($currentId) {
                DB::table('oauth_access_tokens')
                    ->where('user_id', $currentId)
                    ->delete();
            }
        }

        // return null
        return response()->json(null, 204);
    }
   
}