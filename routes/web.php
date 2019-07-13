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
  //Route::get('/', 'DashboardController@index')->name('partners');
  Route::get('/', 'PostsController@main')->name('partners');

  Route::resource('/points', 'PointController', ['as' => 'partners']);

  Route::group(['prefix'=>'posts', 'as'=>'partners'], function(){
    Route::get('/', 'PostsController@index');
    Route::get('/date/{date}', 'PostsController@view_date');
    Route::get('/view/1', 'PostsController@show');//show->where(['id'=>'[0-9]+'])

    Route::get('/graphics', 'PostsController@graphics');
  });
});

Route::group(['namespace'=>'Admin', 'middleware'=>['auth']], function(){
  Route::resource('/admin/company', 'CompanyController', ['as' => 'admin']);
  Route::get('/admin/statistics', 'StatisticsController@view')->name('admin.statistics');
  Route::get('/partners/statistics/graphics', 'StatisticsController@graphics')->name('admin.statistics.graphics');

  Route::get('/partners/company', 'CompanyController@show')->name('partners.company');
  Route::get('/partners/company/edit', 'CompanyController@edit')->name('partners.company.edit');
  Route::put('/partners/company/edit', 'CompanyController@update');

  Route::get('/partners/statistics', 'StatisticsController@view')->name('partners.statistics');
  Route::get('/partners/statistics/graphics', 'StatisticsController@graphics')->name('partners.statistics.graphics');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
  return redirect()->route('partners');
});
