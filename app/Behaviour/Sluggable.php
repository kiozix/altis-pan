<?php
/**
 * Created by PhpStorm.
 * User: Emile
 * Date: 03/01/2016
 * Time: 11:20
 */

namespace App\Behaviour;


use Illuminate\Support\Str;

trait Sluggable {

    public function setSlugAttribute($slug) {
        if(empty($slug)) {
            $this->attributes['slug'] = Str::slug($this->name);
        }
    }
}