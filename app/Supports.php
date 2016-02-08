<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Guard;
class Supports extends Model {

    public $fillable = ['id_author', 'message', 'title', 'reply', 'associated', 'content', 'etat'];

}
