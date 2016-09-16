@extends('layouts.admin')

@section('content')
	<h1 class="text-center">Uploaded Media</h1>
	@if($photos)
		<div class="table-responsive">
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Id</th>
			        <th>Name</th>
			        <th>Created</th>
			        <th>Delete</th>
			      </tr>
			    </thead>
			    <tbody>
			    @foreach($photos as $photo)
				    <tr>
				     	<td>{{ $photo->id }}</td>
				        <td><img width="100" height="77" src="{{ $photo->file }}"></td>
				        <td>{{ $photo->created_at ? $photo->created_at->diffForHumans() : 'No date' }}</td>
				        <td>
			        		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy' , $photo->id ]]) !!}
								<div class="form-group">
									{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
								</div>							
							{!! Form::close() !!}
				        </td>
				    </tr>
				@endforeach
			    </tbody>
			</table>
		</div>
	@endif

	<div class="row">
		<div class="col-sm-6 col-sm-offset-4">
			{{ $photos->render() }}
		</div>
	</div>
@stop