<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Shops extends Model {

    public $fillable = ['name', 'content', 'price', 'time', 'image'];

}
