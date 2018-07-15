<?php

namespace App\Http\Controllers;

use App\Post;
use App\Thread;
use App\Reaction;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'body' => 'required'
         ]);

        //Create Post
        $post_params = array();
        $post_params['body'] = $request->input('body');
        $post_params['user_id'] = auth()->user()->id;
        $post_params['status'] = Post::STATUSES['open'];
        $post_params['vote_up'] = 0;
        $post_params['vote_down'] = 0;
        $post_params['thread_id'] = $request->input('thread-id');
        Post::create($post_params);

        //Redirect
        return back()->withMessage("Post created!");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //Validate
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post->body = $request->input('body');
        $post->save();

        //Redirect
        return back()->withMessage("Post updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->status = Post::STATUSES['deleted'];

        return response()->json(['result' => $post->save()]);
    }

    public function voteUp(Request $request, Post $post)
    {
        //Validate if row exists
        $reactions = Reaction::where('target_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->where('target_type', 'post')->get();
        $saved = false;

        if (count($reactions) == 0)
        {
            $post->vote_up++;
            $post->save();

            $reaction_params = array();
            $reaction_params['target_id'] = $post->id;
            $reaction_params['user_id'] = auth()->user()->id;
            $reaction_params['target_type'] = 'post';
            $reaction_params['reaction'] = Reaction::REACTIONS['vote_up'];
            Reaction::create($reaction_params);
            $saved = true;
        }

        return response()->json([
            'saved' => $saved
        ]);
    }

    public function voteDown(Request $request, Post $post)
    {
        //Validate if row exists
        $reactions = Reaction::where('target_id', $post->id)
            ->where('user_id', auth()->user()->id)
            ->where('target_type', 'post')->get();
        $saved = false;

        if (count($reactions) == 0)
        {
            $post->vote_down++;
            $post->save();

            $reaction_params = array();
            $reaction_params['target_id'] = $post->id;
            $reaction_params['user_id'] = auth()->user()->id;
            $reaction_params['target_type'] = 'post';
            $reaction_params['reaction'] = Reaction::REACTIONS['vote_down'];
            Reaction::create($reaction_params);
            $saved = true;
        }

        return response()->json([
            'saved' => $saved
        ]);
    }
}
