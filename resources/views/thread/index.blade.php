@extends('layouts.front', ['action' => 'index'])

@section('banner')
	<div class="container-fluid" >
		<div class="jumbotron">
			<h1 style="font-size:4em;">ConEx</h1>
		</div>
	</div>
@endsection

@section('heading', "Threads")

@section('content')


	@include ('thread.partials.thread-list')

@endsection