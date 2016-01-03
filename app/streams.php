<?php namespace App;

use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Streams extends Model {

	public $fillable = ['name', 'slug', 'content'];

    use Sluggable;

}
