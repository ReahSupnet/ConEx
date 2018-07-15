
<h4>Forums</h4>
@php
    use App\Category;

    $categories = Category::all();
@endphp

<ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
        @if ($my_posts)
            <a href="{{route('my_posts')}}"> All Thread </a>
        @else
            <a href="{{route('thread.index')}}"> All Thread </a>
        @endif
    </li>
    @foreach ($categories as $category)
        @if ($my_posts)
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" role="button" onclick="window.location.href ='{{route('my_posts', ['categories'=>$category->id])}}'">
                {{$category->name}}
            </li>
        @else
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" role="button" onclick="window.location.href ='{{route('thread.index', ['categories'=>$category->id])}}'">
                {{$category->name}}
                <span class="badge badge-secondary  badge-pill">{{$category->threadCount()}}</span>
            </li>
        @endif
    @endforeach
</ul>


