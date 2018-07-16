@php
    use App\Reaction;
    use App\Thread;
    use App\User;
    use App\Post;
    use App\Category;

    if(auth()->user())
    {
        $total_threads = count(auth()->user()->threads);
        $total_posts = count(auth()->user()->posts);
        $total_likes = count(auth()->user()->reactions()->where('reaction', Reaction::REACTIONS['vote_up'])->get());
        $total_dislikes = count(auth()->user()->reactions()->where('reaction', Reaction::REACTIONS['vote_down'])->get());
        $all_threads = count(Thread::all());
        $all_posts = count(Post::all());
        $all_users = count(User::all());
        $all_categories = count(Category::all());
    }
@endphp