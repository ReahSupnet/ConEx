<?php use App\Post; ?>

@extends('layouts.front', ['action' => 'create_post'])

@section('banner')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 style="font-size: 4em;">ConEx</h1>
        </div>
    </div>
@endsection

@section('heading', "Posts")

@section('sorting')

    <div class="nav-item dropdown">
        <button class="nav-link dropdown-toggle btn btn-primary btn-sm pull-right" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 14px; margin-bottom: 10px;">Sort by</button>
        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
            <a class="dropdown-item" href="/thread/{{$thread->id}}?sort_key=created_at&sort_order=desc">Newest first</a>
            <a class="dropdown-item" href="/thread/{{$thread->id}}?sort_key=created_at&sort_order=asc">Oldest first</a>
            <a class="dropdown-item" href="/thread/{{$thread->id}}?sort_key=vote_up&sort_order=desc">Most liked first</a>
        </div>
    </div>

@endsection

@section('content')

<table class="table table-bordered">
    <tr class="row m-0 table-light">
        <td class="d-inline-block col-1" >
            <div class="badge badge-pill badge-success" >{{$thread->vote_up}}</div>
            <div class="badge badge-pill badge-danger" >{{$thread->vote_down}}</div>
        <td class="d-inline-block col-11"><h4 style="margin: -5px; color: black;"> {{$thread->subject}} </h4>
            <li class="row" style="margin: 10px 0 -10px -20px;">
                <div class="d-inline-block col-4"> Posted by: {{$thread->user->name}}</div>
                <div class="d-inline-block col-4"> {{$thread->created_at->diffForHumans()}}</div>
                <div class="d-inline-block offset-2 col-2">Comments &nbsp;
                    <span class="badge badge-pill badge-primary">{{$thread->postCount()}}</span>
                </div>
            </li>
        </td>
    </tr>
</table>

<ul>
    @foreach($posts as $post)
        <div class="list-group" id="actual_post_{{$post->id}}">
            <div class="list-group-item">
                <div class="media">
                    <img class="align-self-start mr-3" width="5%" src="{{$post->user->getGravatarUrl()}}" alt="Generic placeholder image">
                    <div class="media-body">
                         <div style="font-size: 13px;">{{$post->user->name}} wrote:</div>

                        <div id="post_content_{{$post->id}}">
                            @switch ($post->status)
                                @case (Post::STATUSES['open'])
                                    <div>{!! ($post->body) !!}</div>
                                    @break
                                @case (Post::STATUSES['blocked'])
                                    <div>This message has been blocked</div>
                                    @break
                                @case (Post::STATUSES['deleted'])
                                    <div>This message has been deleted by USERNAME</div>
                                    @break
                            @endswitch
                         </div>
                    </div>
                </div>
            </div>
            <div class="list-group-item bg-light" style="font-size: 14px;" >
                <span class="d-inline-block col-3"> {{$thread->created_at->diffForHumans()}}</span>
                <span class="d-inline-block offset-2 col-4">

                    @if(auth()->user())
                        <button type="button" class=" btn btn-sm btn-success pull-right" onclick="postVoteUp({{$post->id}}, {{auth()->user()->id}})">vote-up</button>&nbsp;
                    @elseif(!(auth()->user()))
                        <button type="button" class=" btn btn-sm btn-success pull-right">vote-up</button>&nbsp;
                    @endif

                    <span class="badge badge-success" id="post_{{$post->id}}_up">{{$post->vote_up}}</span> |
                    <span class="badge badge-danger" id="post_{{$post->id}}_down"> {{$post->vote_down}}</span>&nbsp;&nbsp;

                    @if(auth()->user())
                        <button type="button" class=" btn btn-sm btn-danger pull-right" onclick="postVoteDown({{$post->id}}, {{auth()->user()->id}})">vote-down</button>
                    @elseif(!(auth()->user()))
                        <button type="button" class=" btn btn-sm btn-danger pull-right">vote-down</button>&nbsp;
                    @endif
                </span>


                <div class="pull-right" style="float: right;">


                @if (auth()->user() && auth()->user()->isAdmin())
                        <button type="button" class=" btn btn-sm btn-success pull-right" onclick="showEditSection({{$post->id}})">Update</button>
                        <button type="button" class=" btn btn-sm btn-danger pull-right" onclick="confirmPostDelete({{$post->id}}, {{$thread->id}})">Block</button>
                @elseif (auth()->user() && $post->user->id == auth()->user()->id)
                    <button type="button" class=" btn btn-sm btn-primary pull-right" onclick="showEditSection({{$post->id}})">Update</button>

                @endif

                </div>
            </div>
        </div>

        {{--Edit Post--}}
        @if (auth()->user() && $post->status == Post::STATUSES['open'] && $post->user->id == auth()->user()->id)
            <div class="list-group" id="edit_post_{{$post->id}}" style="display:none;">
                <form class="form-vertical" action="{{route('post.update', ['id' => $post->id])}}" method="Post" role="form" id="create-thread-form">
                    {{csrf_field()}}
                    <div class="list-group-item">
                        <div class="media">
                            <img class="align-self-start mr-3" width="5%" src="{{$post->user->getGravatarUrl()}}" alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="form-group">
                                    <label for="body"> Edit Post </label>

                                    <textarea type="textarea" class="form-control" name="body" id="article-ckeditor_{{$post->id}}" placeholder="Enter message here" rows="3" value="{{$post->body}}" style="margin-top: 10px;"></textarea>

                                    <div class="form-group">
                                        <input type="hidden" value="{{$thread->id}}" name="thread-id">
                                    </div>

                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}

                                    <div class="pull-right" style="float:right; margin-top: 10px;">
                                        <button type="button" class="btn btn-danger btn-md" onclick="hideEditSection({{$post->id}})">Cancel</button>
                                        <button type="submit" class="btn btn-info btn-md">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        <br>
    @endforeach

    @if (auth()->user())
        <hr>
        <div class="list-group" id="create_post">
            <form class="form-vertical" action="{{route('post.store')}}" method="Post" role="form" id="create-thread-form">
                {{csrf_field()}}
                <div class="list-group-item">
                    <div class="media">
                        <img class="align-self-start mr-3" src="{{auth()->user()->getGravatarUrl()}}" alt="Generic placeholder image">
                        <div class="media-body">
                            <div class="form-group">
                                <label for="body"> Post a Reply </label>

                                <textarea type="textarea" class="form-control" name="body" id="article-ckeditor" placeholder="Enter message here" rows="3" value="{{old('body')}}" style="margin-top: 10px;"></textarea>

                                <div class="form-group">
                                    <input type="hidden" value="{{$thread->id}}" name="thread-id">
                                </div>

                                <div class="pull-right" style="float:right; margin-top: 10px;">
                                    <button type="submit" class="btn btn-primary btn-md" >Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
</ul>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script> CKEDITOR.replace( 'article-ckeditor' ); </script>

@endsection