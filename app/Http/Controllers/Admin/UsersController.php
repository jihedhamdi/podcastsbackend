<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.gestion.show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gestion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'email_verified_at' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $request['password'] = bcrypt($request->password);
        if ($request['email_verified_at'] == 1) {
            $current_timestamp = Carbon::now()->format('Y-m-d H:i:s');
            $request['email_verified_at'] = $current_timestamp;
            //dd( $request['email_verified_at']);
        } else {
            $request['email_verified_at'] = Null;
        }
        $users = User::create($request->all());
        return redirect(route('gestion-users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.gestion.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // 'password' => 'required|string|min:6',
        ]);
        $request->status ?: $request['status'] = 0;
        if ($request['email_verified_at'] == 1 && $request['verified_date'] != Null) {
            $request['email_verified_at'] = $request['verified_date'];
        } elseif ($request['email_verified_at'] == 1) {
            $current_timestamp = Carbon::now()->format('Y-m-d H:i:s');
            $request['email_verified_at'] = $current_timestamp;
        }else {
            $request['email_verified_at'] = Null;
        }
        $user = User::where('id', $id)->update($request->except('_token', '_method', 'role', 'verified_date'));
        return redirect(route('gestion-users.index'))->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('message', 'User is deleted successfully');
    }
    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
