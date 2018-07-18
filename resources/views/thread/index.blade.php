@extends('layouts.front', ['action' => 'index'])

@section('banner')

	@include('layouts.partials.header')

@endsection

@section('heading', "Threads")

@section('content')


	@include ('thread.partials.thread-list')

@endsection