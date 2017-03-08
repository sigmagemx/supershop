<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Delivery;

class CheckoutController extends Controller
{
    public function postRegister(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|max:255|unique:users',
			'name' => 'required|max:255',
			'phone' => 'required|min:6|max:255'
		]);
		
		$user = User::create([
			'email' => $request->email,
			'name' => $request->name,
			'phone' => $request->phone,
			'password' => bcrypt(str_random(20))
		]);
		
		Auth::login($user);
		
		return redirect()->route('orders.create');
	}
	
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'login_email' => 'required|email|max:255',
			'password' => 'required|min:6|max:255'
		]);
		
		if (Auth::attempt(['email' => $request->login_email, 'password' => $request->password])) {			
			return redirect()->route('orders.create');
		}
		
		return redirect()->back();
	}

	public function postDelivery(Request $request)
    {
        $this->validate($request, [
            'city' => 'required|min:3|max:255',
            'street' => 'required|min:3|max:255',
            'house' => 'required|integer',
            'apt' => 'required|integer',
            'delivery' => 'required|integer',
            'comment' => 'max:255'
        ]);
        
        Auth::user()->update($request->all());
        $delivery = Delivery::find($request->delivery);

        return redirect()->route('orders.create')->with(['delivery' => $delivery, 'comment' => $request->comment]);
    }
}
