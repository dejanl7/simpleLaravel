@extends('layouts.admin')

@section('content')
	<h1>Categories</h1>

	<div class="row">
		<div class="col-sm-4">
			{!! Form::model( $category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id ] ]) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name: ') !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-3']) !!}
				</div>
			{!! Form::close() !!}
			

			{{-- Form for DELETE --}}
			{!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id ] ]) !!}
				<div class="form-group">
					{!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-3 col-sm-offset-2']) !!}
				</div>
			{!! Form::close() !!}

		</div><!-- .col-sm-6 -->
		
	
	</div><!-- .row -->
@stop