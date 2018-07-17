@php
    use App\Reaction;
    use App\Thread;
    use App\User;
    use App\Post;
    use App\Category;

    if(auth()->user())
    {
        $all_threads = count(Thread::all());
        $all_posts = count(Post::all());
        $all_users = (count(User::all()));
        $all_categories = count(Category::all());
    }
@endphp

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-3 d-inline-block">
            <div class="card  mb-4">
                <div class="card-header bg-primary text-light"><h3>Total Users</h3></div>

                <div class="card-body">
                    <div class="media">
                        <div class="media-object">
                            <span><img src="{{asset('/icons/users.png')}}" alt=""></span>
                        </div>
                        <div>
                            <h4 class="card-title">Users: {{$all_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-inline-block">
            <div class="card  mb-4">
                <div class="card-header bg-primary text-light"><h3>Threads and Posts</h3></div>

                <div class="card-body">
                    <div class="media">
                        <div class="media-object">
                            <span><img src="{{asset('/icons/threadsPosts.png')}}" alt=""></span>
                        </div>
                        <div>
                            <h4 class="card-title">Threads: {{$all_users}}</h4>
                            <h4 class="card-title">Posts: {{$all_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-inline-block">
            <div class="card  mb-4">
                <div class="card-header bg-primary text-light"><h3>All Categories</h3></div>

                <div class="card-body">
                    <div class="media">
                        <div class="media-object">
                            <span><img src="{{asset('/icons/category.png')}}" alt=""></span>
                        </div>
                        <div>
                            <h4 class="card-title">Categories: {{$all_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>