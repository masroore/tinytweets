@extends('layout.master')

@section('content')
	<h1>User Details</h1>
	<table>
		<tr>
			<td>Real name:</td>
			<td>{{ $user->real_name }}</td>
		</tr>
		<tr>
			<td>Tweets:</td>
			<td>{{ $user->tweets_count() }}</td>
		</tr>
	</table>

	@if ($can_edit == true)
		{{ HTML::route('edit_user', 'Edit Profile', array('id' => $user->id) ) }}
	@endif
@stop