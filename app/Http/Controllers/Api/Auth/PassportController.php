<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

class PassportController extends Controller
{

    public $successStatus = 200;
    

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){

        $validator = Validator::make(['email' => request('email'), 'password' => request('password')], [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * update api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateuser(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $user->name = $input['name'];
        if($user->email !== $input['email'])
            {
                $user->email = $input['email'];
            }
         $user->save();
       
        //$input['password'] = bcrypt($input['password']);
        //$user = User::update($input);
       // $success['token'] =  $user->createToken('MyApp')->accessToken;
       // $success['name'] =  $user->name;

        return response()->json(['success'=>"profile updated successfully"], $this->successStatus);
    }

    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $validator = $this->validatorpassword($request->all());
		if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = bcrypt($request->get('new_password'));
            $user->save();
            return response()->json(['message' => 'Password change successfully.', 'status' => true], 201);
        } else {
            return response()->json(['message' =>'Current password is incorrect', 'status' => false], 401);
        }
    }

    /**
     * Get a validator for an incoming change password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorpassword(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        $user->token()->delete();
        
        $response = ['message' => 'You have been successfully logged out!'];
        return response()->json($response, $this->successStatus);      
       // return response()->json(null, 204);        
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}