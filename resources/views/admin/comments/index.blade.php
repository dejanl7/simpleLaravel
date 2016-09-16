@extends('layouts.admin')

@section('content')
	@if( count($comments) > 0 )
		<h1 class="text-center">Comments</h1>
	
		<div class="table-responsive">
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Id</th>
			        <th>Author</th>
			        <th>Email</th>
			        <th>Body</th>
			        <th>Post</th>
			        <th>Replies</th>
			        <th>Status</th>
			        <th>Delete</th>
			      </tr>
			    </thead>
			    <tbody>
			    @foreach($comments as $comment)
				    <tr>
				    	<td>{{ $comment->id }}</td>
				    	<td>{{ $comment->author }}</td>
				    	<td>{{ $comment->email }}</td>
				    	<td>{{ $comment->body }}</td>
				    	<td><a href="{{ route('home.post', $comment->post->slug) }}">View Post</a></td>
				    	<td><a href="{{ route('admin.comments.replies.show', $comment->id) }}">View Replies</a></td>
				    	<td>	
				    		@if( $comment->is_active == 1 )
				    			{!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentController@update', $comment->id]]) !!}
				    				<input type="hidden" name="is_active" value="0">
									<div class="form-group">
										{!! Form::submit('Disable', ['class'=>'btn btn-warning'] ) !!}
									</div>
								{!! Form::close() !!}
							@else
				    			{!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentController@update', $comment->id]]) !!}
				    				<input type="hidden" name="is_active" value="1">
									<div class="form-group">
										{!! Form::submit('Approve', ['class'=>'btn btn-success'] ) !!}
									</div>
								{!! Form::close() !!}
				    		@endif
				    	</td>
				    	<td>
				    			{!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentController@destroy', $comment->id]]) !!}
				    				<input type="hidden" name="is_active" value="1">
									<div class="form-group">
										{!! Form::submit('Delete', ['class'=>'btn btn-danger'] ) !!}
									</div>
								{!! Form::close() !!}
				    	</td>

				    </tr>
				@endforeach
			    </tbody>
			</table>
		</div>
	@else
		<h1 class="text-center">No Comments</h1>
	@endif

	<div class="row">
		<div class="col-sm-6 col-sm-offset-4">
			{{ $comments->render() }}
		</div>
	</div>
@stop
