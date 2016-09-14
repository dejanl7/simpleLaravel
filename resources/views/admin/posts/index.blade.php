@extends('layouts.admin')

@section('content')

	<h1>All Posts</h1>


	<div class="table-responsive">
		<table class="table table-striped">
		    <thead>
		      <tr>
		     	<th>Photo</th>
		        <th>Owner</th>
		        <th>Category</th>
		        <th>Post Title</th>
		        <th>Post Body</th>
		        <th>View</th>
		        <th>Created</th>
		        <th>Updated</th>
		      </tr>
		    </thead>
		    <tbody>

		   	@if($posts)
				@foreach( $posts as $post )
			      <tr>
			       	<td>
			        	<img height="77" width="127" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/77x77' }}">
			        </td>
			       	<td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->user->name }}</a></td>
			        <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
			        <td>{{ $post->title }}</td>
			        <td>{{ str_limit($post->body, 37) }}</td>
			        <td><a href="{{ route('home.post', $post->slug) }}">View</a></td>
			        <td><a href="{{ route('admin.comments.show', $post->id) }}">See Comments</a></td>
			        <td>{{ $post->created_at->diffForhumans() }}</td>
			        <td>{{ $post->updated_at->diffForhumans() }}</td>
			      </tr>
				@endforeach
		     @endif

		    </tbody>
		 </table>
	</div>

	<div class="row">
		<div class="col-sm-6 col-sm-offset-4">
			{{ $posts->render() }}
		</div>
	</div>
@stop