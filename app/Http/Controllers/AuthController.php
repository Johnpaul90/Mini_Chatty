<?php

namespace Chatty\Http\Controllers;

use Chatty\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getSignUp(){
        return view('auth.signup');

    }

    public function postSignUp(Request $request){
        $this->validate($request,[
            'email'=> 'required|unique:users|email|max:30',
            'username'=> 'required|unique:users|alpha_dash|max:10',
            'password'=> 'required|min:6'
        ]);

        $user= User::create([
            'email'=>$request->input('email'),
            'username'=> $request->input('username'),
            'password'=> bcrypt($request->input('password'))
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('info', 'Your account have been successfully created!');
    }
    public function getSignIn(){
        return view('auth.signin');

    }
    public function postSignIn(Request $request){
        $this->validate($request,[
            'email'=> 'required',
            'password' => 'required'
        ]);
        if (!Auth::attempt($request->only(['email','password']),$request->has('remember'))){
            return redirect()->back()->with('error', 'Invalid username or password. Try again!');
        }
        return redirect()->route('home')->with('info', 'You are now signed in!');
    }
    public function getSignout(){
        Auth::logout();
        return redirect()->route('home')->with('info','You have successfully signed out');
    }
}
