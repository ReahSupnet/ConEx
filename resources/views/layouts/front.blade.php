<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script type="text/javascript" rel="script" src="{{asset('js/app.js')}}"></script>
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

            @yield('content')
        </div>
        <div class="col-md-3 content-heading">

            @if ($action == 'index')
                <div class="col-md-offset-6">
                    <button type="button" class="btn btn-primary btn-lg btn-block" role="button" onclick="window.location.href ='{{route('thread.create')}}'">Create Thread</button>
                </div>
            @endif


            <br>

            <h4>Category</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                    <a  href="{{route('thread.index')}}"> All Thread </a>
                    <span class="badge badge-secondary badge-pill">14</span>
                </li>
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                    <a  href="{{route('thread.index')}}"> {{$category->name}} </a>
                    <span class="badge badge-secondary  badge-pill">5</span>
                </li>
            @endforeach

            <br>

            <div class="card border-primary mb-3" style="max-width: 20rem;">
                <div class="card-header">Header</div>

                <div class="card-body">
                    <h4 class="card-title">Primary card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
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

</body>
</html>
 
