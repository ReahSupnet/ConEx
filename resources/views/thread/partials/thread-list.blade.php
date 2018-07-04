<table class="table table-bordered table-hover">
    @forelse($threads as $thread)
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

    @empty
        <div class="alert alert-dismissible alert-danger">
            {{--<button type="button" class="close" data-dismiss="alert">&times;</button>--}}
            <h4 class="alert-heading">No available threads!</h4>
        </div>

    @endforelse
</table>