<table class="table table-bordered table-hover">
    @forelse($threads as $thread)
        <tr class="row m-0 table-light">
            <td class="d-inline-block col-1" >{{$thread->vote_up}} - {{$thread->vote_down}}</td>
            <td class="d-inline-block col-11">
                <a href="{{route('thread.show', $thread->id)}}"><h4 style="margin: -5px;"> {{$thread->subject}} </h4>
                </a>

                <li class="row" style="margin: 10px 0 -10px -20px;">
                    <div class="d-inline-block col-3"> Posted by: {{$thread->user->name}} </div>
                    <div class="d-inline-block col-4">Date created: {{$thread->created_at}}</div>

                    <div class="d-inline-block offset-1 col-2">Comments
                        <span class="badge badge-info">Info</span>
                    </div>

                    <div class="d-inline-block col-1">Share</div>

                    @if (auth()->user() && (auth()->user()->isAdmin()))
                    <div class="d-inline-block col-1">
                        <button type="button" class="btn btn-sm btn-primary" onclick="">Close</button>
                    </div>
                    @endif

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
