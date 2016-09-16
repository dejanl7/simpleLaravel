@extends('layouts.admin')

@section('content')
	@if( Session::has('deleted_user') )
		<p class="bg-danger">{{ session('deleted_user') }}</p>
	@endif

	<h1 class="text-center">Users</h1>
	
	<div class="table-responsive">
		<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Photo</th>
		        <th>Name</th>
		        <th>E-mail</th>
		        <th>Role</th>
		        <th>Status</th>
		        <th>Created</th>
		        <th>Updated</th>
		      </tr>
		    </thead>
		    <tbody>

		   	@if($users)
				@foreach( $users as $user )
			      <tr>
			        <td>{{ $user->id }}</td>
			        <td>
			        	@if( $user->photo )
			        		<img height="77" width="77" src="{{ $user->photo->file }}">
						@else
							<img src="http://placehold.it/77x77">
						@endif
			        </td>
			        <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
			        <td>{{ $user->email }}</td>
			        <td>{{ $user->role->name }}</td>
					<td>{{ $user->is_active == 1 ? 'Active' : 'No Active' }}</td>
			        <td>{{ $user->created_at->diffForHumans() }}</td>
			        <td>{{ $user->updated_at->diffForHumans() }}</td>
			      </tr>
				@endforeach
		     @endif

		    </tbody>
		 </table>
	</div>
	
	<div class="row">
		<div class="col-sm-6 col-sm-offset-4">
			{{ $users->render() }}
		</div>
	</div>
@stop