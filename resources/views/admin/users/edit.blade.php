@extends('layouts.admin')

@section('content')

	<h1 class="text-center">Edit User</h1>
	
	<div class="row">
		<div class="col-sm-3">
			<img src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" class="img img-responsive img-rounded">
		</div>
		
		<div class="col-sm-9">
			{!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
				<div class="form-group">
					{!! Form::label('name', 'Name: ') !!}
					{!! Form::text('name', null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('email', 'Email: ') !!}
					{!! Form::email('email', null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('role_id', 'Role: ') !!}
					{!! Form::select('role_id', [''=>'Choose Options'] + $roles, null, ['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('is_active', 'Status: ') !!}
					{!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), null, ['class'=>'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('photo_id', 'Title: ') !!}	
					{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('Password', 'Password: ') !!}
					{!! Form::password('password', ['class'=>'form-control']) !!}
				</div>
					<br>
				<div class="form-group">
					{!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-3']) !!}
				</div>
			{!! Form::close() !!}

		
		{{-- Form for DELETE --}}
			{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id ] ]) !!}
				{!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-3']) !!}
			{!! Form::close() !!}
		</div>	

	<div class="row">
		@include('includes.form_error')
	</div>	
	


@stop