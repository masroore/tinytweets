<?php

class BaseModel extends Eloquent {

	public static function validate($input) {
		return Validator::make($input, static::$rules); 
	}
}