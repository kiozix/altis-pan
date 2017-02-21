<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use TimeAgo;

class Thread extends Model {

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function forum(){
        return $this->belongsTo('App\Forum');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function getAgoAttribute() {
        $timeZone = null;
        $timeAgo = new TimeAgo($timeZone, 'fr');
        return $timeAgo->inWords($this->updated_at);
    }

    public function getDateAttribute(){
        $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
        $mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

        $date = New \DateTime($this->created_at);
        $month = $date->format('n');
        return $date->format('d')." ".$mois[$month].", ".$date->format('Y');
    }

    public function getLikedAttribute() {
        if(is_null(\Auth::user())) {
            return false;
        }
        $like = Like::where('thread_id', $this->id)->where('user_id', \Auth::user()->id)->first();

        if (is_null($like)) {
            return false;
        }
        return true;
    }

    static public function del($id) {
        $thread = Thread::where('id', $id)->first();
        $posts = Post::where('thread_id', $thread->id)->get();
        foreach ($posts as $post) {
            Post::del($post->id);
        }
        $likes = Like::where('thread_id', $thread->id)->get();
        foreach ($likes as $like) {
            $like->delete();
        }
        $thread->delete();
    }

}
