<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class ChangePasswordController extends Controller
{

    /**
     * Create a new controller instance.
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/


    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = Auth::getUser();
        $validator = $this->validator($request->all())->validate();
		if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password = $request->get('new_password');
            $user->save();
            return response()->json(['message' => 'assword change successfully.', 'status' => true], 201);
        } else {
            return response()->json()(['message' =>'Current password is incorrect', 'status' => false], 401);
        }
    }

    /**
     * Get a validator for an incoming change password request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    }
}