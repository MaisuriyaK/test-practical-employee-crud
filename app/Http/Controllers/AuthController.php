<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    //

    public function login(){
        return view('auth.login');
    }

    public function postLogin(Request $request){
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('employee.index')->withSuccess('You have successfully logged in');
        }else{
            return redirect()->route('login')->withSuccess('Opps! You have entered invalid credentials');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
