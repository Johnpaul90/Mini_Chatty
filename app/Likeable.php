<?php

namespace Chatty;

use Illuminate\Database\Eloquent\Model;

class Likeable extends Model
{
    protected $table = 'likeables';

    public function likeable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo('Chatty\User','user_id');
    }
}
