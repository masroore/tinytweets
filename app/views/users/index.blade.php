@extends('layout.master')

@section('content')
<div id="ask">
	<h1>List of Users</h1>
	@foreach ($users as $user)
		{{ $user->real_name }}<br />
	@endforeach
</div><!-- end ask -->
@stop