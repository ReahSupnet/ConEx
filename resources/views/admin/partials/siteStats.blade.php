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
                <div class="card-header bg-primary text-light"><h3>Users</h3></div>

                <div class="card-body">
                    <div class="media">
                        <div class="media-object">
                            <span><img src="https://icons8.com" alt=""></span>
                        </div>
                        <div>
                            <h4 class="card-title">Total {{$all_users}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-inline-block">
            <div class="card mb-4">
                <div class="card-header bg-primary text-light"><h3>Threads and Posts</h3></div>

                <div class="card-body">
                    <h4 class="card-title">Primary card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 d-inline-block">
            <div class="card mb-4">
                <div class="card-header bg-primary text-light"><h3>Categories</h3></div>

                <div class="card-body">
                    <h4 class="card-title">Primary card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
</div>