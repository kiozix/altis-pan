<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use TimeAgo;

class Post extends Model {

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function thread(){
        return $this->belongsTo('App\Thread');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function getDateAttribute(){
        $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
        $mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

        $date = New \DateTime($this->created_at);
        $month = $date->format('n');
        return $date->format('d')." ".$mois[$month].", ".$date->format('Y');
    }

    public function getAgoAttribute() {
        $timeZone = null;
        $timeAgo = new TimeAgo($timeZone, 'fr');
        return $timeAgo->inWords($this->updated_at);
    }

    public function getLikedAttribute() {
        if(is_null(\Auth::user())) {
            return false;
        }
        $like = Like::where('post_id', $this->id)->where('user_id', \Auth::user()->id)->first();

        if (is_null($like)) {
            return false;
        }
        return true;
    }

    static public function del($id) {
        $post = Post::where('id', $id)->first();
        $likes = Like::where('post_id', $post->id)->get();
        foreach ($likes as $like) {
            $like->delete();
        }
        $post->delete();
    }
}
