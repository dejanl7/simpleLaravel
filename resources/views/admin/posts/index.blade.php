@extends('layouts.admin')

@section('content')

	<h1>All Posts</h1>


	<table class="table-responsive">
		<table class="table table-striped">
		    <thead>
		      <tr>
		     	<th>Photo</th>
		        <th>User</th>
		        <th>Category</th>
		        <th>Post Title</th>
		        <th>Post Body</th>
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
			       	<td>{{ $post->user->name }}</td>
			        <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
			        <td>{{ $post->title }}</td>
			        <td>{{ $post->body }}</td>
			        <td>{{ $post->created_at->diffForhumans() }}</td>
			        <td>{{ $post->updated_at->diffForhumans() }}</td>
			      </tr>
				@endforeach
		     @endif

		    </tbody>
		 </table>
	</table>

@stop