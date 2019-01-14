<?php

Route::group(['middleware' => 'guest'], function() {
	Route::view('login', 'login')->name('login');
	Route::post('login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth'], function() {
	Route::view('/', 'home');

	Route::post('forward', 'OtherController@forward');
	Route::get('check', 'OtherController@check');

	Route::get('arsip-surat', 'InController@index');
	Route::get('lihat-surat/{id}', 'InController@show');
	Route::post('arsip', 'InController@store');

	Route::get('mail.id', 'InController@code');

	Route::get('laporan', 'OtherController@report');
	Route::get('filter/report', 'OtherController@filter');
	Route::get('filter', 'OtherController@filter');

	Route::get('inbox', 'OtherController@inbox');
	Route::get('detail-surat/{id}', 'OtherController@read');

	Route::get('print-surat/{id}', 'OtherController@print');

	Route::get('count.unread', 'OtherController@count');
	Route::get('load', 'OtherController@loadInbox');

	Route::resource('user', 'userController', ['except' => ['create', 'edit', 'show']]);
	Route::resource('division', 'divisionController', ['except' => ['create', 'edit', 'show']]);

	Route::get('logout', 'Auth\LoginController@logout');
});
