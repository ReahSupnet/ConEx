<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-bordered table-hover">
        @forelse($threads as $thread)
            <tr class="row m-0 table-light">
                <td class="d-inline-block col-md-12">
                    <a href="{{route('thread.show', $thread->id)}}"><h4 class="text-info" style="margin: -5px;"> {{$thread->subject}} </h4>
                    </a>

                    <li class="row" style="margin: 10px 0 -10px -20px;">

                        <div class="d-inline-block col-2"> Posted by: {!! $thread->user->printNameWithLink() !!} </div>
                        <div class="d-inline-block col-3"> {{$thread->created_at->diffForHumans()}}</div>

                        <div class="d-inline-block col-3">

                            @if(auth()->user())
                                <span><img width='12%' src="{{( asset('icons/thumbsUp.png'))}}" onclick="threadVoteUp({{$thread->id}}, {{auth()->user()->id}})"></span>
                            @elseif(!(auth()->user()))
                                <span><img width='12%' src="{{( asset('icons/thumbsUp.png'))}}"> </span>

                            @endif

                               <span class="badge badge-success" id="thread_{{$thread->id}}_up">{{$thread->vote_up}}</span>
                             | <span class="badge badge-danger" id="thread_{{$thread->id}}_down">{{$thread->vote_down}}</span>

                            @if(auth()->user())
                                <span><img width='12%' src="{{( asset('icons/thunbsDown.png'))}}" onclick="threadVoteUp({{$thread->id}}, {{auth()->user()->id}})"></span>
                            @elseif (!(auth()->user()))
                                <span><img width='12%' src="{{( asset('icons/thunbsDown.png'))}}"> </span>
                            @endif

                        </div>

                        <div class="d-inline-block col-2">Posts
                            <span class="badge badge-primary">{{$thread->postCount()}}</span>
                        </div>

                        <div class="d-inline-block col-1"><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                            target="_blank" role="button">
                            <span><img width="60%" src="{{(asset('icons/share.png'))}}"    </span>
                            </a></div>
                    </li>
                </td>
            </tr>

        @empty
            <div class="alert alert-dismissible alert-danger">
                {{--<button type="button" class="close" data-dismiss="alert">&times;</button>--}}
                <h4 class="alert-heading">No available threads!</h4>
            </div>

        @endforelse

        {{ $threads->links() }}

    </table>
</div>

{{ $threads->links() }}









