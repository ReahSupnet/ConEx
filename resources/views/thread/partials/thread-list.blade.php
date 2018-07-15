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
                                <button type="button" class=" btn btn-sm btn-success pull-right" onclick="threadVoteUp({{$thread->id}}, {{auth()->user()->id}})">G</button>
                            @endif
                            <span class="badge badge-success" id="thread_{{$thread->id}}_up">{{$thread->vote_up}}</span>
                            @if(auth()->user())
                                <button type="button" class=" btn btn-sm btn-danger pull-right" onclick="threadVoteDown({{$thread->id}}, {{auth()->user()->id}})">NG</button>
                            @endif
                            <span class="badge badge-danger" id="thread_{{$thread->id}}_down">{{$thread->vote_down}}</span>
                        </div>

                        <div class="d-inline-block col-2">Comments
                            <span class="badge badge-primary">{{$thread->postCount()}}</span>
                        </div>

                        <div class="d-inline-block col-2"><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                            target="_blank" role="button" class="btn btn-primary btn-sm">
                            Share on Fb
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








