<?php

namespace App\Http\Controllers;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Thread;
use App\Category;
use App\Post;
use Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function __construct() {
//        $this->middleware(['auth', 'clearance'])->except('index', 'show');
//
//    }

    public function index()
    {
        $threads = Thread::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        return view('thread.index')->with('threads', $threads)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view( 'thread.create')->with('categories', $categories);
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
        $thread_params['user_id'] = 1; // TODO: Update me later
        $thread = Thread::create($thread_params);

        //Create first post
        $post_params = array();
        $post_params['body'] = $request->input('body');
        $post_params['user_id'] = 1; // TODO: Update me later
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = Thread::find($id);
        $posts = $thread->posts;
        $categories = Category::all();

        return view('thread.show')->with('thread', $thread)->with('posts', $posts)->with('categories', $categories);
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
}
