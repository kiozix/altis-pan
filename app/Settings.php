<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
class Settings extends Model {

    public $fillable = ['action', 'value_associated', 'name'];

}
