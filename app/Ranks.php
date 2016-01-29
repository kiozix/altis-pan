<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
class Ranks extends Model {

    public $fillable = ['side', 'value_associated', 'name'];

}
