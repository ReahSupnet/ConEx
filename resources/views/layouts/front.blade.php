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
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/united/bootstrap.min.css">

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
            <h4 class="main-content-heading">@yield('heading')</h4>

            @include('layouts.partials.error')

            @yield('content')
        </div>

        <div class="col-md-3 content-heading">
            @if(auth()->user() && !(auth()->user()->isAdmin()))
                <div class="card border-primary">
                    <div class="container" align="center" style="padding:20px;">
                        <img src="https://placeimg.com/200/200/nature" alt="" style="border: 2px solid black; width:200px; heigh:200px; border-radius:50%;">
                    </div>
                    <div class="container">
                        <h4>Welcome back, <strong>{{auth()->user()->name}}</strong>!</h4>
                        <p> You have participated in ____ Threads </p>
                        <p> Created _____ posts </p>
                        <p> _____ Likes and _____ Dislikes</p>
                    </div>
                    {{--{{auth()->user()->postsCount()}}--}}
                </div>
            @endif

            <br>

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
 
