<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model {

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function thread(){
        return $this->belongsTo('App\Thread');
    }

}
