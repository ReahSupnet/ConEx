@extends('layouts.front', ['action' => 'create_post'])

@section('banner')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>My Forums</h1>
        </div>
    </div>
@endsection


@section('heading', "Thread")

@section('content')

    <table class="table table-bordered">
        <tr class="row m-0 table-light">
            <td class="d-inline-block col-1" >{{$thread->vote_up}} - {{$thread->vote_down}}</td>
            <td class="d-inline-block col-11" ><a href="{{route('thread.show', $thread->id)}}"><h4 style="margin: -5px;"> {{$thread->subject}} </h4></a>
                <li style="list-style: none; margin: -5px;" > Created by: Date created: {{$thread->created_at}}</li>
                <li class="row" style="margin: 10px 0 -10px -20px;">
                    <div class="d-inline-block col-2">Comments</div>
                    <div class="d-inline-block col-2">Share</div>
                </li>
            </td>
        </tr>
    </table>

    <ul>
        @foreach($posts as $post)
            <div class="list-group">
                <div class="list-group-item">
                    <div class="media">
                        <img class="align-self-start mr-3" src="http://placehold.jp/006699/cccc00/50x50.png" alt="Generic placeholder image">
                        <div class="media-body">
                            <p>{!! ($post->body) !!}</p>
                        </div>
                    </div>
                </div>
                <div class="list-group-item bg-light" style="font-size: 14px;" >
                    <span class="d-inline-block col-2">vote-up &nbsp;&nbsp; vote-down</span>
                    <span class="d-inline-block offset-1 col-3">Posted on: {{$thread->created_at}}</span>
                    <span class="d-inline-block offset-1 col-2">Comments
                    <span class="badge badge-info">Info</span>
                </span>
                    <span class="d-inline-block col-1">Share</span>
                    <div class="pull-right" style="float: right;">
                        <button type="button" class=" btn btn-sm btn-danger pull-right" action="">Delete</button>
                    </div>
                </div>
            </div>
            <br>
        @endforeach

        <div class="list-group" id="create_post">
            <form class="form-vertical" action="{{route('thread.store')}}" method="Post" role="form" id="create-thread-form">
                {{csrf_field()}}
                <div class="list-group-item">
                    <div class="media">
                        <img class="align-self-start mr-3" src="http://placehold.jp/006699/cccc00/50x50.png" alt="Generic placeholder image">
                        <div class="media-body">
                            <div class="form-group">
                                <label for="body"> Post a Reply </label>

                                <textarea type="textarea" class="form-control" name="body" id="article-ckeditor" placeholder="Enter message here" rows="3" value="{{old('body')}}" style="margin-top: 10px;"></textarea>

                                <div class="form-group">
                                    <input type="text" value="{{$thread->id}}" hidden name="thread-id">
                                </div>

                                {{method_field('PUT')}}
                                {{csrf_field()}}

                                <div class="pull-right" style="float:right; margin-top: 10px;">
                                    <button type="submit" class="btn btn-info btn-md" >Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </ul>



@endsection