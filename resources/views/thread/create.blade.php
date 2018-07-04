@extends('layouts.front', ['action' => 'create'])

@section('banner')
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>My Forums</h1>
		</div>
	</div>
@endsection


@section('heading', "Create Thread")

@section('content')
	
	@include('layouts.partials.error')

	@include('layouts.partials.success')

		<div class="card bg-light mb-3">
			<div class="container" style="margin: 10px; padding-right: 30px;">
			<form class="form-vertical" action="{{route('thread.store')}}" method="Post" role="form" id="create-thread-form">
				{{csrf_field()}}

				<div class="form-group">
					<label for="category"> Category </label>
					<input type="text" class="form-control" name="category" id="" placeholder="Enter Category" value="{{old('category')}}">
				</div>

				<div class="form-group">
					<label for="subject"> Subject </label>
					<textarea type="textarea" class="form-control" name="subject" id="" placeholder="Enter Thread" rows="3" value="{{old('subject')}}"></textarea>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@endsection