@extends('layout.master')

@section('content')
	<h1>Register</h1>

	@if($errors->has())
		<p>The following errors have occurred:</p>

		<ul id="form-errors">
			{{ $errors->first('real_name', '<li>:message</li>') }}
			{{ $errors->first('username', '<li>:message</li>') }}
			{{ $errors->first('password', '<li>:message</li>') }}
			{{ $errors->first('password_confirmation', '<li>:message</li>') }}
		</ul>
	@endif

	{{ Form::open('register', 'POST') }}

	{{ Form::hidden('csrf_token', Session::getToken()) }}

	<p>
		{{ Form::label('real_name', 'Real Name') }}<br />
		{{ Form::text('real_name', Input::old('real_name')) }}
	</p>

	<p>
		{{ Form::label('username', 'Username') }}<br />
		{{ Form::text('username', Input::old('username')) }}
	</p>

	<p>
		{{ Form::label('password', 'Password') }}<br />
		{{ Form::password('password') }}
	</p>

	<p>
		{{ Form::label('password_confirmation', 'Confirm Password') }}<br />
		{{ Form::password('password_confirmation') }}
	</p>

	<p>{{ Form::submit('Register') }}</p>

	{{ Form::close() }}  
@stop