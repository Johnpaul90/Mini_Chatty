<?php

namespace Chatty;

use Chatty\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table ='users';

    protected $fillable =['username', 'email', 'password','first_name','last_name','location'];

    protected $hidden =['password', 'remember_token'];

    public function getName(){
        if ($this->first_name && $this->last_name){
            return "{$this->first_name} {$this->last_name}";
        }
        if ($this->first_name){
            return "{$this->first_name}";
        }
        return null;
    }
    public function getNameOrUsername(){
        return $this->getName()?:$this->username;
    }
    public function getFirstNameOrUsername(){
        if ($this->first_name){
            return "{$this->first_name}";
        }
        return $this->username;
    }
    public function getAvatarUrl(){
        return "https://www.gravatar.com/avatar/{{md5($this->email)}}?d=mm&s=40";
    }
    public function friendsOfMine(){
        return $this->belongsToMany('Chatty\User','friends', 'user_id', 'friend_id');
    }
    public function friendsOf(){
        return $this->belongsToMany('Chatty\User','friends', 'friend_id','user_id');
    }
    public function statuses(){
        return $this->hasMany('Chatty\Status','user_id');
    }
    public function likes(){
        return $this->hasMany('Chatty\Likeable','user_id');
    }
    public  function  friends(){
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()->merge($this->friendsOf()->wherePivot('accepted',true)->get());
    }
    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted',false)->get();
    }
    public function friendRequestPending(){
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }
    public function hasFriendRequestPending(User $user){
        return (bool)$this->friendRequestPending()->where('id', $user->id)->count();
    }
    public function hasFriendRequestReceived(User $user){
        return (bool)$this->friendRequests()->where('id', $user->id)->count();
    }
    public function addFriend(User $user){
        return $this->friendsOf()->attach($user->id, ['accepted'=>false]);
    }
    public function deleteFriend(User $user){
        return $this->friendsOf()->detach($user->id, ['accepted'=>false]);
        return $this->friendsOfMine()->detach($user->id,['accepted->false']);
    }

    public function acceptFriendRequest(User $user){
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
             'accepted'=>true,
        ]);
    }
    public function isFriendsWith(User $user){
        return (bool)$this->friends()->where('id',$user->id)->count();
    }
    public function hasLikedStatus(Status $status){
        return (bool) $status->likes
            ->where('likeable_id', $status->id)
            ->where('likeable_type',get_class($status))
            ->where('user_id',$this->id)
            ->count();

    }
}

