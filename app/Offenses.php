<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
class Offenses extends Model {

    public $fillable = ['name', 'arma_id', 'content', 'author', 'author_id', 'sanction'];

}
