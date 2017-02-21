<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'categories';

    public function forums(){
        return $this->hasMany('App\Forum');
    }

    static public function del($id) {
        $category = Category::where('id', $id)->first();
        $forums = Forum::where('category_id', $category->id)->get();
        foreach ($forums as $forum) {
            Forum::del($forum->id);
        }
        $category->delete();
    }
}
