<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'UsersController@index' ));

Route::get('logout', array('as' => 'logout', 'uses' => 'UsersController@logout' ));
Route::get('tweets', array('as' => 'tweets', 'uses' => 'UsersController@index' ));

Route::get('register', array('as' => 'register', 'uses' => 'UsersController@create' ));
Route::post('register', array('before'=>'csrf', 'uses'=>'UsersController@store'));

Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login' ));
Route::post('login', array('before'=>'csrf', 'uses'=>'UsersController@do_login'));

Route::get('users/{id}', array('as' =>'show_user', 'uses'=>'UsersController@show'))->where('id', '\d+');
Route::get('users/{id}/edit', array('as' =>'edit_user', 'before'=>'auth', 'uses'=>'UsersController@edit'))->where('id', '\d+');
Route::post('users/{id}/edit', array('before'=>'csrf', 'uses'=>'UsersController@save_profile'))->where('id', '\d+');

//Route::controller('UsersController', 'users');

Route::resource('users', 'UsersController');