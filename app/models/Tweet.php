<?php

class Tweet extends BaseModel {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */	
	protected $table = 'tweets';

	//public static $timestamps = true;

	public static $rules = array(
		'content' => 'Required|Max:140',
		'user_id' => 'Required|Integer|Exists:users,id'
		);

	/**
	 * Get the author of the twit.
	 *
	 * @return mixed
	 */
	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}