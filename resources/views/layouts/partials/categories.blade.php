<h4>Forums</h4>
<ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
        @if ($my_posts)
            <a href="{{route('my_posts')}}"> All Thread </a>
        @else
            <a href="{{route('thread.index')}}"> All Thread </a>
        @endif
        <span class="badge badge-secondary badge-pill">14</span>
    </li>
    @foreach ($categories as $category)
        @if ($my_posts)
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" role="button" onclick="window.location.href ='{{route('my_posts', ['categories'=>$category->id])}}'">
                {{$category->name}}
                <span class="badge badge-secondary  badge-pill">5</span>
            </li>
        @else
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" role="button" onclick="window.location.href ='{{route('thread.index', ['categories'=>$category->id])}}'">
                {{$category->name}}
                <span class="badge badge-secondary  badge-pill">5</span>
            </li>
        @endif
    @endforeach