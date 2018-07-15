@php
    use App\Category;

    $categories = Category::all();
@endphp

@if(auth()->user() && auth()->user()->isAdmin())
    <ul class="list-group">
        <div class="form-group card-header text-white bg-primary">
            <h5>Categories</h5>
        </div>
        @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action" role="button">
                {{$category->name}}
                <button type="button" class="btn btn-danger" onclick="confirmCategoryDelete({{$category->id}})">Delete</button>
            </li>
        @endforeach
    </ul>
    <div class="card">
        <form action="{{route('category.store')}}" method="POST" role="form">
            {{csrf_field()}}

            <div class="card-body">
                <input type="text" class="form-control" name="name" placeholder="Enter New Category">
                <br>
                <div class="pull-right">
                    <button type="submit" class="btn btn-dark">Add</button>
                </div>
            </div>
        </form>
    </div>
@endif
<br>
