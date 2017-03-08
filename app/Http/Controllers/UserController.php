<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user-info', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('shop.account', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'password' => 'min:6|max:255|confirmed',
            'phone' => 'required|min:6|max:255',
            'city' => 'required|min:3|max:255',
            'street' => 'required|min:3|max:255',
            'house' => 'required|integer',
            'apt' => 'required|integer'
        ]);
        
        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;

        if ($request->password) {
            Auth::user()->password = bcrypt($request->password);
        }

        Auth::user()->phone = $request->phone;
        Auth::user()->city = $request->city;
        Auth::user()->street = $request->street;
        Auth::user()->house = $request->house;
        Auth::user()->apt = $request->apt;
        Auth::user()->save();
        
        return redirect()->route('users.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->orderItems()->delete();
        $user->orders()->delete();
        $user->delete();
        
        return redirect()->route('users.index');
    }
}