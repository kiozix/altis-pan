<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use App\Like;
use App\Post;
use App\Thread;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForumsController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'forum', 'thread']]);
    }

    public function index() {
        $categories = Category::orderBy('order', 'ASC')->get();
        $player = null;
        if(\Auth::user()) {
            if(\Auth::user()->arma) {
                $player = DB::table('players')->where('playerid', \Auth::user()->arma)->first();
            }
        }

        return view('forum.index', compact('categories', 'player'));
    }

    public function forum($forum_slug) {
        $forum = Forum::where('slug', $forum_slug)->first();
        if(is_null($forum)) {
            abort(404);
        }

        if(Forum::canSee($forum->id, \Auth::user()) == false) {
            abort(403);
        }

        $threads = Thread::orderBy('updated_at', 'DESC')->where('forum_id', $forum->id)->where('sticky', 0)->paginate(10);
        $stickys = Thread::orderBy('updated_at', 'DESC')->where('forum_id', $forum->id)->where('sticky', 1)->get();

        return view('forum.forum', compact('forum', 'threads', 'stickys'));
    }

    public function thread($id) {
        $thread = Thread::where('id', $id)->first();
        if(is_null($thread)) {
            abort(404);
        }

        if(Forum::canSee($thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }

        $posts = Post::where('thread_id', $thread->id)->paginate(10);
        $categories = Category::all();

        return view('forum.thread', compact('thread', 'posts', 'categories'));
    }

    public function thread_create() {
        $thread = new Thread();
        $categories = Category::all();
        $player = null;
        if(\Auth::user()) {
            if(\Auth::user()->arma) {
                $player = DB::table('players')->where('playerid', \Auth::user()->arma)->first();
            }
        }
        return view('forum.create', compact('thread', 'categories', 'player'));
    }

    public function thread_store(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:4',
            'forum' => 'required|exists:forums,id',
            'content' => 'required|min:10'
        ]);

        if(Forum::canSee($request->get('forum'), \Auth::user()) == false) {
            abort(403);
        }
        if(Forum::canPost($request->get('forum'), \Auth::user()) == false) {
            abort(403);
        }

        $thread = new Thread();
        $thread->forum_id = $request->get('forum');
        $thread->name = $request->get('name');
        $thread->user_id = \Auth::user()->id;
        $thread->content = $request->get('content');
        $thread->save();

        return redirect()->route('forum.thread', $thread->id)->with('success', 'Le sujet à bien été créer');
    }

    public function thread_like($id) {
        $topic = Thread::find($id);
        if(is_null($topic)) {
            abort(404);
        }

        if(Forum::canSee($topic->forum->id, \Auth::user()) == false) {
            abort(403);
        }

        $already = Like::where('thread_id', $topic->id)->where('user_id', \Auth::user()->id)->first();
        if($already) {
            $already->delete();
            return redirect()->back()->with('success', 'Votres unlike à bien été pris en compte. :(');
        }

        $like = New Like();
        $like->thread_id = $topic->id;
        $like->user_id = \Auth::user()->id;
        $like->save();

        return redirect()->back()->with('success', 'Merci de votre like.');
    }

    public function thread_update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required|min:4',
            'forum' => 'required|exists:forums,id'
        ]);
        $thread = Thread::where('id', $id)->first();

        if(Forum::canSee($thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }
        if(Forum::canSee($thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }
        if(is_null($thread)) {
            abort(404);
        }
        if($thread->user->id != \Auth::user()->id && \Auth::user()->rank < 2) {
            abort(403);
        }

        $thread->name = $request->input('name');
        $thread->forum_id = $request->input('forum');
        if (\Auth::user()->rank >= 2) {
            $thread->sticky = $request->input('sticky');
            $thread->lock = $request->input('lock');
        }
        $thread->save();

        return redirect(route('forum.thread', $thread))->with('success', 'Le sujet a bien été édité.');
    }

    public function thread_content($id, Request $request) {
        $this->validate($request, [
            'content' => 'required|min:10'
        ]);
        $thread = Thread::where('id', $id)->first();
        if(Forum::canSee($thread->forum->id, \Auth::user()) == false) {
            return json_encode(['response' => '403 - Forbidden']);
        }
        if(Forum::canPost($thread->forum->id, \Auth::user()) == false) {
            return json_encode(['response' => '403 - Forbidden']);
        }
        if(is_null($thread)) {
            return json_encode(['response' => '403 - Forbidden']);
        }
        if($thread->user->id != \Auth::user()->id && \Auth::user()->rank < 2) {
            return json_encode(['response' => 'Ce topic ne vous appartient pas']);
        }

        $thread->content = $request->input('content');
        $thread->save();

        return json_encode(['response' => 'success']);
    }

    public function thread_delete($id) {
        $thread = Thread::find($id);
        if(is_null($thread)) {
            abort(404);
        }
        if(Forum::canSee($thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }
        if(Forum::canPost($thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }
        if($thread->user->id != \Auth::user()->id && \Auth::user()->rank < 2) {
            abort(403);
        }

        $return = $thread->forum->slug;
        Thread::del($thread->id);

        return redirect()->route('forum.show', $return)->with('success', 'Le topic à bien été supprimer');
    }

    public function post_store($id, Request $request) {
        $this->validate($request, [
            'content' => 'required|min:10'
        ]);
        $thread = Thread::where('id', $id)->first();
        if(is_null($thread)) {
            abort(404);
        }
        if(Forum::canSee($thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }

        if ($thread->lock) {
            return redirect(route('forum.thread', $thread))->with('error', 'Le sujet est vérouiller.');
        }

        $post = new Post();
        $post->thread_id = $thread->id;
        $post->user_id = \Auth::user()->id;
        $post->content = $request->input('content');
        $post->save();

        $thread->save();

        return redirect(route('forum.thread', $thread))->with('success', 'Votre réponse a bien été posté.');
    }

    public function post_like($id) {
        $post = Post::find($id);
        if(is_null($post)) {
            abort(404);
        }
        if(Forum::canSee($post->thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }

        $already = Like::where('post_id', $post->id)->where('user_id', \Auth::user()->id)->first();
        if($already) {
            $already->delete();
            return redirect()->back()->with('success', 'Votres unlike à bien été pris en compte. :(');
        }

        $like = New Like();
        $like->post_id = $post->id;
        $like->user_id = \Auth::user()->id;
        $like->save();

        return redirect()->back()->with('success', 'Merci de votre like.');
    }

    public function post_delete($id) {
        $post = Post::find($id);
        if(is_null($post)) {
            abort(404);
        }
        if(Forum::canSee($post->thread->forum->id, \Auth::user()) == false) {
            abort(403);
        }
        if($post->user->id != \Auth::user()->id && \Auth::user()->rank < 2) {
            abort(403);
        }
        $return = $post->thread_id;
        Post::del($post->id);
        return redirect()->route('forum.thread', $return)->with('success', 'La réponse à bien été supprimer');
    }
}