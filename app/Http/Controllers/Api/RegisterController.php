<?php

namespace App\Http\Controllers\Api;

use App\Model\user\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $request
         * @return \Illuminate\Contracts\Validation\Validator
         */
        $valid = validator($request->only('email', 'name', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);
    
        if ($valid->fails()) {
            $jsonError=response()->json($valid->errors()->all(), 400);
            return json_encode($jsonError);
        }
    
        $data = request()->only('email','name','password');
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    
        // And created user until here.
    
       // $client = Client::where('password_client', 1)->first();
    
        // Is this $request the same request? I mean Request $request? Then wouldn't it mess the other $request stuff? Also how did you pass it on the $request in $proxy? Wouldn't Request::create() just create a new thing?
    
        // $request->request->add([
        //     'grant_type'    => 'password',
        //     'client_id'     => $client->id,
        //     'client_secret' => $client->secret,
        //     'username'      => $data['email'],
        //     'password'      => $data['password'],
        //     'scope'         => null,
        // ]);
    
        // Fire off the internal request. 
        $token = Request::create(
            'oauth/token',
            'POST'
        );
        return json_encode($token);
    }

}
