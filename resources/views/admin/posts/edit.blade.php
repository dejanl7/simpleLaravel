@extends('layouts.admin')


@section('content')

	<h1>Edit Post</h1>
	<div class="row">
		<div class="col-sm-3 col-xs-12">
			<img src="{{ $posts->photo->file }}" class="img img-responsive">
		</div>

		<div class="col-sm-9 col-xs-12">
			{!! Form::model($posts, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $posts->id] , 'files'=>true]) !!}
				<div class="form-group">
					{!! Form::label('title', 'Title: ') !!}
					{!! Form::text('title', null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('category_id', 'Category: ') !!}
					{!! Form::select('category_id', [''=>'Choose Category'] + $categories , null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('photo_id', 'Photo: ') !!}	
					{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('body', 'Description: ') !!}
					{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>7]) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-2']) !!}
				</div>
			{!! Form::close() !!}

			
			{{-- Form for DELETE --}}
				{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $posts->id ] ]) !!}
					{!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-2 col-sm-offset-1']) !!}
				{!! Form::close() !!} 
		</div>
	</div>
	<div class="row">
		@include('includes.form_error')
	</div>



@stop