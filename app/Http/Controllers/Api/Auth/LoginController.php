<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user'] = $user;
            return response()->json($success, 200);
        }
        else {
            $response = ["request" =>$request,"message" =>'User does not exist'];
            return response($request, 422);
        }

        //return $this->sendFailedLoginResponse($request);
    }


    public function getDetails()
    {
        $user = Auth::user();
        $success['user'] = $user;
        return response()->json($success, 200);
    }
    
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        $user->token()->delete();
        
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response, 200);      
       // return response()->json(null, 204);        
    }
}
