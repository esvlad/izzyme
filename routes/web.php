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

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
  Route::get('/', 'DashboardController@dashboard')->name('admin.index');

  Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function(){
    Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
  });
});

Route::group(['prefix'=>'partners', 'namespace'=>'Partners', 'middleware'=>['auth']], function(){
  Route::get('/', 'DashboardController@index')->name('partners');

  Route::resource('/point', 'PointController', ['as' => 'partners']);

  Route::group(['prefix'=>'posts', 'as'=>'partners'], function(){
    Route::get('/', 'PostsController@index');
    Route::get('/date/{date}', 'PostsController@view_date');
    Route::get('/view/{id}', 'PostsController@show')->where(['id'=>'[0-9]+']);
  });
});

Route::group(['namespace'=>'Admin', 'middleware'=>['auth']], function(){
  Route::resource('/admin/company', 'CompanyController', ['as' => 'admin']);
  Route::get('/admin/statistics', 'StatisticsController@view')->name('admin');

  Route::get('/partners/company', 'CompanyController@show')->name('partners');
  Route::get('/partners/company/edit', 'CompanyController@edit')->name('partners');
  Route::put('/partners/company/edit', 'CompanyController@update')->name('partners');

  Route::get('/partners/statistics', 'StatisticsController@view')->name('partners');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
