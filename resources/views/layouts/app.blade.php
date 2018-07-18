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


@include ('layouts.partials.navbar')

<br>

@yield ('content')

<div id="loginfooter">
@include('layouts.partials.footer')
</div>
</body>
</html>
