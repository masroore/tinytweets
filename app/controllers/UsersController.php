<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return View::make('users.index')
			->with(['title' => "users", 'users' => $users]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create')
			->with(['title' => 'Register']);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$v = User::validate(Input::all());
		if ($v->passes()) {
			$username =  strtolower(Input::get('username'));
			User::create([
				'username' => $username,
				'password' => Hash::make(Input::get('password')),
				'real_name' => Input::get('real_name'),
				]);
			
			$user = User::where('username', '=', $username)->first();
			
			Auth::login($user);

			return Redirect::route('home')
				->with('flash', 'Thanks for registering. Your are now logged in!');
		}

		return Redirect::route('register')
			->withErrors($v)
			->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$id = intval($id);
		$user = User::find($id);
		$can_edit = Auth::check() && $id == intval(Auth::user()->id);

		return View::make('users.show')
				->with('user', $user)
				->with('can_edit', $can_edit)
				->with('title', 'User Details');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$id = intval($id);
		$user = User::find($id);
		return View::make('users.edit')
			->with('user', $user)
			->with('title', 'Edit Profile');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		return 'update ' . $id;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		return 'destroy ' . $id;
	}

	public function logout()
	{
		if (Auth::check()) {
			Auth::logout();
			return Redirect::route('home')
				->with('flash', 'You are now logged out.');
		}
		
		return Redirect::route('home')->with('title', 'Home');
	}

	public function login() {
		return View::make('users.login')
			->with('title', 'Login');
	}

	public function do_login()
	{
		$user = array(
			'username'=>Input::get('username'),
			'password'=>Input::get('password')
		);

		if (Auth::attempt($user)) {
			return Redirect::route('home')->with('flash', 'You are logged in!');
		} else {
			return Redirect::route('login')
				->with('flash', 'Your username/password combination was incorrect')
				->withInput();
		}  
	}

	public function save_profile($id)
	{
		$id = intval($id);
	 	$rules = array(
			'real_name' => 'Required|Between:4,128',
			'password' => 'Required|Between:4,8|AlphaNum|Confirmed',
			'password_confirmation' => 'Required|Between:4,8|AlphaNum',
			);

		$v = Validator::make(Input::all(), $rules); 
		if ($v->passes()) {
			$user = User::find($id);
			$user->real_name = Input::get('real_name');
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::route('home')
				->with('flash', 'Your profile has been saved.');
		}

		return Redirect::route('edit_user', array('id' => $id))
			->withErrors($v);
	}
}