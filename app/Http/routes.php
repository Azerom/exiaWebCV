<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('/test', function () {
    return view('test');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

	Route::get('/', function () {
		return view('welcome');
	});

	Route::get('/home', function() {
		return;
	});
	
	Route::get('/profil', function() {
		return;
	});

	Route::get('/profils', 'ProfilController@viewAll');
	
	Route::get('/profil/{id}','ProfilController@viewOne');

	Route::get('/modify/{id}', 'ProfilController@modify')->name("getModify");
	Route::post('/modify/{id}', 'ProfilController@modify');

	Route::get('/modify/{id}/skills', 'ProfilController@modifySkills')->name("getModifySkills");
	Route::post('/modify/{id}/skills', 'ProfilController@modifySkills');

	Route::get('/modify/{id}/form', 'ProfilController@modifyFormations')->name("getModifyFormations");
	Route::post('/modify/{id}/form', 'ProfilController@modifyFormations');

	Route::get('/modify/{id}/project', 'ProfilController@modifyProject')->name("getModifyProject");
	Route::post('/modify/{id}/project', 'ProfilController@modifyProject');

	Route::get('/delete/{id}', 'ProfilController@delete');
	
    Route::get('/home', 'HomeController@index');
});

