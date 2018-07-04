<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
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
        $threads = Thread::paginate(5);
        return view('thread.index')->with('threads', $threads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'thread.create');
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
            'subject' => 'required|min:10'
        ]);

        $params = $request->all();
        $params['vote_up'] = 0;
        $params['vote_down'] = 0;

        //Store
        Thread::create($params);


        //Redirect
        return back()->withMessage("Thread created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('thread.show_thread')->with('thread', Thread::find($id));
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
        //
    }
}
