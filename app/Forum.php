<?php namespace App;

use App\Http\Controllers\PlayersController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Forum extends Model {

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function threads(){
        return $this->hasMany('App\Thread');
    }

    static public function del($forum_id) {
        $forum = Forum::where('id', $forum_id)->first();
        $threads = Thread::where('forum_id', $forum->id)->get();
        foreach ($threads as $thread) {
            Thread::del($thread->id);
        }
        $forum->delete();
    }

    static public function canSee($forum_id, $user) {
        $forum = Forum::where('id', $forum_id)->first();
        $player = null;
        if($user) {
            if($user->arma) {
                $player = DB::table('players')->where('playerid', $user->arma)->first();
            }
        }
        $access = false;

        if ($user) {
            if($forum->moderator_see == null && $forum->support_see == null && $forum->cop_see == null && $forum->medic_see == null && $forum->gang_see == null) {
                $access = true;
            } elseif ($user->rank == 3) {
                $access = true;
            } else {
                if($forum->moderator_see == true && $user->rank == 2) {
                    $access = true;
                } elseif ($forum->support_see == true && $user->rank == 1) {
                    $access = true;
                } elseif ($player != null && $forum->cop_see == true || $player != null && $forum->medic_see == true || $player != null && $forum->gang_see) {
                    if ($forum->cop_see == true && $player->coplevel != 0) {
                        $access = true;
                    } elseif ($forum->medic_see == true && $player->mediclevel != 0) {
                        $access = true;
                    } elseif (PlayersController::inGang($player->playerid, $forum->gang_see) == true) {
                        $access = true;
                    }
                }
            }
        } else {
            if ($forum->moderator_see == null && $forum->support_see == null && $forum->cop_see == null && $forum->medic_see == null && $forum->gang_see == null) {
                $access = true;
            }
        }

        return $access;
    }

    static public function canPost($forum_id, $user) {
        $forum = Forum::where('id', $forum_id)->first();
        $player = null;
        if($user) {
            if($user->arma) {
                $player = DB::table('players')->where('playerid', $user->arma)->first();
            }
        }
        $access = false;

        if ($user) {
            if($forum->moderator_post == null && $forum->support_post == null && $forum->cop_post == null && $forum->medic_post == null && $forum->gang_post == null) {
                $access = true;
            } elseif ($user->rank == 3) {
                $access = true;
            } else {
                if($forum->moderator_post == true && $user->rank == 2) {
                    $access = true;
                } elseif ($forum->support_post == true && $user->rank == 1) {
                    $access = true;
                } elseif ($player != null && $forum->cop_post == true || $player != null && $forum->medic_post == true || $player != null && $forum->gang_post) {
                    if ($forum->cop_post == true && $player->coplevel != 0) {
                        $access = true;
                    } elseif ($forum->medic_post == true && $player->mediclevel != 0) {
                        $access = true;
                    } elseif (PlayersController::inGang($player->playerid, $forum->gang_post) == true) {
                        $access = true;
                    }
                }
            }
        } else {
            if ($forum->moderator_post == null && $forum->support_post == null && $forum->cop_post == null && $forum->medic_post == null && $forum->gang_post == null) {
                $access = true;
            }
        }

        return $access;
    }
}
