<!DOCTYPE html>
<html>
<head>
	<title>TinyTweets - {{ $title }}</title>
	{{ HTML::style('/css/style.css') }}
</head> 
<body>
	<div id="container">

		<div id="header">
			{{ HTML::route('home', 'TinyTweets') }}
		</div><!-- end header -->

		<div id="nav">
			<ul>
				<li>{{ HTML::route('home', 'Home') }}</li>
				@if(!Auth::check())
					<li>{{ HTML::route('register', 'Register') }}</li>
					<li>{{ HTML::route('login', 'Login') }}</li>
				@else 
					<li>{{ HTML::route('show_user', "Profile", array('id' => Auth::user()->id )) }}</li>
					<li>{{ HTML::route('tweets', "Your Tweets") }}</li>
					<li>{{ HTML::route('logout', 'Logout ('.Auth::user()->username.')') }}</li>
				@endif 				
			</ul>
		</div><!-- end nav -->

		<div id="content">
			@if(Session::has('flash'))
				<p id="message">{{ Session::get('flash') }}</p>
			@endif

			@yield('content')
		</div><!-- end content -->

		<div id="footer">
			TinyTweets &copy; {{ HTML::to('http://laravelbook.com/', 'LaravelBook')  . ' ' . date('Y') }} 
		</div><!-- end footer -->

	</div><!-- end container -->
</body>
</html>