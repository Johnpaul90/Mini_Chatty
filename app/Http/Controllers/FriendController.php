<?php

namespace Chatty\Http\Controllers;

use Chatty\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function getIndex(){
        $friends= Auth::user()->friends();
        $requests =Auth::user()->friendRequests();
        return view('friends.index')->with('friends',$friends)->with('requests',$requests);
    }
    public function getAddFriends($username){
        $user=User::where('username',$username)->first();

        if (!$user){
            return redirect()->route('home')->with('error','User not found. Please try another search!');
        }
        if (Auth::user()->id===$user->id){
            return redirect()->route('home')->with('error','You cannot be friends with yourself!');
        }
        if (Auth::user()->hasFriendRequestPending($user)||$user->hasFriendRequestPending(Auth::user())){
            return redirect()->route('profile.index',['username'=>$user->username])->with('error', 'Request already pending');
        }
        if (Auth::user()->isFriendsWith($user)){
            return redirect()->route('profile.index',['username'=>$user->username])->with('error', 'You are already friends');
        }
        Auth::user()->addFriend($user);
        return redirect()->route('profile.index',['username'=>$username])->with('info', 'Friend request sent');
    }
    public  function getAcceptFriends($username){
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found. Please try another search!');
        }
        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect()->route('home');
        }
        Auth::user()->acceptFriendRequest($user);
        return redirect()->route('profile.index',['username'=>$username])->with('info', 'Friend request accepted');
    }
    public function postDelete($username){
        $user = User::where('username', $username)->first();
        if (!Auth::user()->isFriendsWith($user)){
            return redirect()->back();
        }

        Auth::user()->deleteFriend($user);

        return redirect()->back()->with('info', 'Friends successfully deleted');

    }
}
