<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Behaviour\Sluggable;

class Pages extends Model {

    public $fillable = ['name', 'slug', 'content'];

    use Sluggable;

}
