<?php

namespace Chatty\Http\Controllers;

use Chatty\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile($username){
        $user= User::where('username',$username)->first();
        if (!$user){
            abort(404);
        }
        $statuses = $user->statuses()->notReply()->get();
         return view('profile.index')
             ->with('user',$user)
             ->with('statuses',$statuses)
             ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
    }
    public function getEdit(){
        return view('profile.edit');
    }
    public function postEdit(Request $request){
        $this->validate($request,[
           'first_name'=> 'alpha|max:50',
            'last_name'=> 'alpha|max:50',
            'location'=> 'max:20'
        ]);
         Auth::user()->update([
             'first_name'=> $request->input('first_name'),
             'last_name'=> $request->input('last_name'),
             'location'=> $request->input('location')
         ]);

        return redirect()->route('profile.edit')->with('info','Profile successfully updated!');
    }
}
