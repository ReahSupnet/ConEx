<?php

namespace App\Http\Controllers;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Thread;
use App\Category;
use App\Post;
use App\Reaction;
use Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth',['except' => ['index', 'show'] ]);
    }

    public function index(Request $request)
    {

        if (auth()->user() && auth()->user()->isBanned())
        {
            auth()->logout();
            return redirect('/')->with('message', 'Your account has been banned');
        }

        if ($request->input('search'))
        {
            $threads = Thread::where('subject' , 'like' , '%' . $request->input('search') . '%')->orderBy('created_at', 'desc')->paginate(10);
        }
        elseif ($request->input('categories'))
        {
            $threads = Thread::where('category_id', $request->input('categories'))->orderBy('created_at', 'desc')->paginate(10);
        }
        else
        {
            $threads = Thread::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('thread.index')->with('threads', $threads)->with('my_posts', false);
    }

    public function myPosts(Request $request)
    {
        if ($request->input('categories'))
        {
            $threads = Thread::join('posts', 'threads.id', 'posts.thread_id')->select('threads.*', 'posts.user_id as post_user_id')->where('posts.user_id', auth()->user()->id)->where('category_id', $request->input('categories'))->distinct('threads.id')->paginate(10);
        }
        else
        {
            $threads = Thread::join('posts', 'threads.id', 'posts.thread_id')->select('threads.*', 'posts.user_id as post_user_id')->where('posts.user_id', auth()->user()->id)->distinct('threads.id')->paginate(10);
        }



        return view('thread.index')->with('threads', $threads)->with('my_posts', true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view( 'thread.create')->with('categories', $categories)->with('my_posts', false);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate

        $this->validate($request,[
            'category_id' => 'required',
            'subject' => 'required|min:10'
        ]);

        //Create thread
        $thread_params['category_id'] = $request->input('category_id');
        $thread_params['subject'] = $request->input('subject');
        $thread_params['vote_up'] = 0;
        $thread_params['vote_down'] = 0;
        $thread_params['status'] = Thread::STATUSES['open'];
        $thread_params['user_id'] = auth()->user()->id;
        $thread = Thread::create($thread_params);

        //Create first post
        $post_params = array();
        $post_params['body'] = $request->input('body');
        $post_params['user_id'] = auth()->user()->id;
        $post_params['status'] = Post::STATUSES['open'];
        $post_params['vote_up'] = 0;
        $post_params['vote_down'] = 0;
        $post_params['thread_id'] = $thread->id;
        Post::create($post_params);


        //Redirect
        return redirect()->route('thread.show', $thread)->withMessage("Thread created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @param  Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Thread $thread)
    {
        $sort_key = $request->input('sort_key') ? $request->input('sort_key') : 'created_at';
        $sort_order = $request->input('sort_order') ? $request->input('sort_order') : 'asc';
        $posts = $thread->posts()->orderBy($sort_key, $sort_order)->get();

        return view('thread.show')->with('thread', $thread)->with('posts', $posts)->with('my_posts', false);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function voteUp(Request $request, Thread $thread)
    {
        //Validate if row exists
        $reactions = Reaction::where('target_id', $thread->id)
            ->where('user_id', auth()->user()->id)
            ->where('target_type', 'thread')->get();
        $saved = false;

        if (count($reactions) == 0)
        {
            $thread->vote_up++;
            $thread->save();

            $reaction_params = array();
            $reaction_params['target_id'] = $thread->id;
            $reaction_params['user_id'] = auth()->user()->id;
            $reaction_params['target_type'] = 'thread';
            $reaction_params['reaction'] = Reaction::REACTIONS['vote_up'];
            Reaction::create($reaction_params);
            $saved = true;
        }

        return response()->json([
            'saved' => $saved
        ]);
    }

    public function voteDown(Request $request, Thread $thread)
    {
        //Validate if row exists
        $reactions = Reaction::where('target_id', $thread->id)
            ->where('user_id', auth()->user()->id)
            ->where('target_type', 'thread')->get();
        $saved = false;

        if (count($reactions) == 0)
        {
            $thread->vote_down++;
            $thread->save();

            $reaction_params = array();
            $reaction_params['target_id'] = $thread->id;
            $reaction_params['user_id'] = auth()->user()->id;
            $reaction_params['target_type'] = 'thread';
            $reaction_params['reaction'] = Reaction::REACTIONS['vote_down'];
            Reaction::create($reaction_params);
            $saved = true;
        }

        return response()->json([
            'saved' => $saved
        ]);
    }

}
