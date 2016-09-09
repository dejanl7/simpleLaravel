@extends('layouts.admin')

@section('content')
	<h1>Categories</h1>

	<div class="row">
		<div class="col-sm-4">
			{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name: ') !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}


		</div><!-- .col-sm-6 -->
		<div class="col-sm-5 col-sm-offset-1">
			@if( $categories )
				<div class="table-responsive">
					<table class="table table-striped">
					    <thead>
					      <tr>
					        <th>Id</th>
					        <th>Name</th>
					        <th>Created</th>
					      </tr>
					    </thead>
					    <tbody>

					   	@if($categories)
							@foreach( $categories as $category )
								<td>{{ $category->id }}</td>
						        <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
						        <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'No Date' }}</td>
						      </tr>
							@endforeach
					     @endif

					    </tbody>
				 	</table>
				</div>
			@endif
		</div><!-- .col-sm-6 -->
	
	</div><!-- .row -->
@stop