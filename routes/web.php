<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'Admin'],function(){
	Route::get('login','LoginController@login')->name('login');
	Route::post('postLogin','LoginController@postLogin')->name('postLogin');
	 Route::get('password-reset', 'PasswordResetController@resetForm')->name('password-reset');
    Route::post('send-email-link', 'PasswordResetController@sendEmailLink')->name('sendEmailLink');
    Route::get('reset-password/{token}', 'PasswordResetController@passwordResetForm')->name('passwordResetForm');
    Route::post('update-password', 'PasswordResetController@updatePassword')->name('updatePassword');
});
Route::group(['namespace'=>'Admin','middleware'=>['auth'],'prefix'=>'admin'],function(){
	Route::resource('dashboard','DashboardController');
	Route::get('logout','LoginController@Logout')->name('logout');
	Route::group(['middleware'=>['role']],function(){
		Route::resource('category','CategoryController');
		Route::post('category-sortable','CategoryController@categorysortable')->name('sortableCategory');
		Route::resource('tag','TagController');
		
		Route::resource('user','UserController');
		Route::post('news/post-order-change','PostController@PostOrderChange')->name('postChangeOrder');
		Route::post('news/remove-image','PostController@removeImage')->name('removeImage');
		Route::resource('news','PostController');

		Route::resource('video','VideoController');
		Route::resource('setting','SettingController');
		Route::resource('page','PageController');
		Route::resource('advert','AdvertisementController');
	});
	Route::resource('team','TeamController');
	
	Route::resource('photo','PhotoController');

	Route::post('change-active-status','CategoryController@changeStatus')->name('changeStatus');
});

Route::group(['namespace'=>'Front'],function(){
	Route::get('/','DefaultController@index')->name('home');
	Route::get('post/{slug}','DefaultController@postInner')->name('postInner');
	Route::get('videos','DefaultController@allVideos')->name('allVideos');
	Route::get('trend/{slug}','DefaultController@trends')->name('trends');
	Route::get('unicode','DefaultController@unicode')->name('unicode');
	Route::post('search','DefaultController@searchResult')->name('search');
	Route::get('page/{slug}','DefaultController@Page')->name('page');
	Route::get('/{slug}','DefaultController@category')->name('category');
});
