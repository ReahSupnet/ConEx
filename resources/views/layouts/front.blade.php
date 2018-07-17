<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ConEx') }}</title>

    <!-- Scripts -->
    <script type="text/javascript" rel="script" src="{{asset('js/app.js')}}"></script>
    <script src="{{ asset('js/thread_scripts.js') }}"></script>
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
    {{--<link href="{{ asset('/vendor/components/font-awesome/css/fontawesome-all.css')}} " rel="stylesheet">--}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


</head>
<body>

@include ('layouts.partials.navbar')

<br>

@yield ('banner')


<div  class="container-fluid" id="app">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="d-inline-block col-md-2">
                    <h4 class="main-content-heading">@yield('heading')</h4>
                </div>

                @if(auth()->user())
                <div class="d-inline-block offset-8 col-md-2">
                    @yield('sorting')
                </div>
                @endif
            </div>


            @include('layouts.partials.error')

            @yield('content')
        </div>

        <div class="col-md-3 content-heading">

            {{--@include('layouts.partials.helpers')--}}

            @php
                use App\Reaction;

                if(auth()->user())
                {
                    $total_threads = count(auth()->user()->threads);
                    $total_posts = count(auth()->user()->posts);
                    $total_likes = count(auth()->user()->reactions()->where('reaction', Reaction::REACTIONS['vote_up'])->get());
                    $total_dislikes = count(auth()->user()->reactions()->where('reaction', Reaction::REACTIONS['vote_down'])->get());
                }
            @endphp

            @if(auth()->user() && !(auth()->user()->isAdmin()))
                <div class="card border-primary">
                    <div class="container" align="center" style="padding:20px;">
                        <img src="https://placeimg.com/200/200/nature" alt="" style="border: 2px solid black; width:200px; heigh:200px; border-radius:50%;">
                    </div>
                    <div class="container">
                        <h4> Welcome back, <strong style="color:orangered;">{{auth()->user()->name}}</strong>!</h4>
                        <p> You have participated in <span class="badge badge-pill badge-info">{{$total_threads}}</span> Threads </p>
                        <p> Created <span class="badge badge-pill badge-info"> {{$total_posts}} </span> posts  </p>
                        <p> Liked Threads and Posts: <span class="badge badge-pill badge-success">{{$total_likes}} </span>  </p>
                        <p> Disliked Threads and Posts: <span class="badge badge-pill badge-danger">{{$total_dislikes}} </span></p>
                    </div>
                    {{--{{auth()->user()->postsCount()}}--}}
                </div>
            @endif

            <br>
            @if(auth()->user() && !(auth()->user()->isAdmin()))
                <form class="input-group custom-search-form" action="{{route('thread.index')}}" method="GET">
                    <input type="text" class="form-control" name="search" placeholder="Search Threads">
                    <span class="input-group-btn">
                        <button class="btn btn-primary-sm bg-warning" type="submit">
                            {{--<i class="fa fa-search"></i>--}}Submit
                        </button>
                    </span>
                </form>
                <br>
            @endif

            @if ($action == 'index' || $action == 'create_post')
                <div class="col-md-offset-6">
                    <button type="button" class="btn btn-primary btn-lg btn-block" role="button" onclick="window.location.href ='{{route('thread.create')}}'">Create Thread</button>
                </div>

                <br>
                @include('layouts.partials.categories')
                <br>
                @include('layouts.partials.ads')

            @else
                    @include('admin.partials.adminCategory')
            @endif

        </div>
    </div>
</div>

@include('layouts.partials.footer')



<!-- jquery -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
<!-- boostrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.timestamp = +new Date;
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>

<script>
$(document).on('click', '.social-share', function(event){
event.preventDefault();

var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

var url = $(this).attr('href');
var popup = window.open(url, 'Social Share',
'width='+popupMeta.width+',height='+popupMeta.height+
',left='+vpPsition+',top='+hPosition+
',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

if (popup) {
popup.focus();
return false;
}
});</script>

</body>
</html>
 
