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
					<select class="form-control" name="category_id" id="" placeholder="Enter Category">
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="subject"> Subject </label>
					<textarea type="textarea" class="form-control" name="subject" id="" placeholder="Enter Thread" rows="1" value="{{old('subject')}}"></textarea>
				</div>

				<div class="form-group">
					<label for="body"> Body </label>
					<textarea type="textarea" class="form-control" name="body" id="article-ckeditor" placeholder="..." rows="5" value="{{old('subject')}}"></textarea>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>

	<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
	<script> CKEDITOR.replace( 'article-ckeditor' ); </script>
@endsection