@extends('layouts.admin')

@section('content')

	@if( count($replies) > 0 )
		<h1>replies</h1>
		<div class="table-responsive">
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Id</th>
			        <th>Author1</th>
			        <th>Email</th>
			        <th>Body</th>
			        <th>Post</th>
			        <th>Approve /<br>Unapprove</th>
			        <th>Delete</th>
			        <th>Time</th>
			      </tr>
			    </thead>
			    <tbody>
				    <tr>
				    @foreach( $replies as $reply )
				    	<td>{{ $reply->id }}</td>
				    	<td>{{ $reply->author }}</td>
				    	<td>{{ $reply->email }}</td>
				    	<td>{{ $reply->body }}</td>
				    	<td><a href="{{ route('home.post', $reply->comment->post->id) }}">View Post</a></td>
				    	<td>	
				    		@if( $reply->is_active == 1 )
				    			{!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
				    				<input type="hidden" name="is_active" value="0">
									<div class="form-group">
										{!! Form::submit('Disable', ['class'=>'btn btn-danger'] ) !!}
									</div>
								{!! Form::close() !!}
							@else
				    			{!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
				    				<input type="hidden" name="is_active" value="1">
									<div class="form-group">
										{!! Form::submit('Approve', ['class'=>'btn btn-success'] ) !!}
									</div>
								{!! Form::close() !!}
				    		@endif
				    	</td>
				    	<td>
				    			{!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
				    				<input type="hidden" name="is_active" value="1">
									<div class="form-group">
										{!! Form::submit('Delete', ['class'=>'btn btn-danger'] ) !!}
									</div>
								{!! Form::close() !!}
				    	</td>
						<td>{{ $reply->created_at->diffforhumans() }}</td>
				    </tr>	
				    @endforeach
			    </tbody>
			</table>
		</div>
		
	@else
		<h1 class="text-center">No replies</h1>

	@endif
@stop