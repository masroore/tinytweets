<?php

use Illuminate\Auth\UserInterface;

class User extends BaseModel implements UserInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public static $rules = array(
		'real_name' => 'Required|Between:4,128',
		'username' => 'Required|Between:4,16|Unique:users|AlphaDash',
		'password' => 'Required|Between:4,8|AlphaNum|Confirmed',
		'password_confirmation' => 'Required|Between:4,8|AlphaNum',
		);

	//public static $timestamps = true;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get all twits posted by the user.
	 *
	 * @return array
	 */
	public function tweets()
	{
		return $this->hasMany('Tweet');
	}

	public function tweets_count()
	{
		return DB::table('users')
			->join('tweets', 'users.id', '=', 'tweets.user_id')
			->where('users.id', '=', $this->id)
			->count('*');
	}

}