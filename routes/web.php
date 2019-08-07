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

  Route::resource('/user', 'UserManagment\UserController', ['as' => 'admin.user_managment']);

  Route::resource('/points', 'PointsController', ['as' => 'admin']);
  Route::get('/posts', 'PostsController@index')->name('admin.posts.index');
  Route::get('/posts/{post}', 'PostsController@show')->name('admin.posts.show');
});

Route::group(['prefix'=>'partners', 'namespace'=>'Partners', 'middleware'=>['auth']], function(){
  Route::get('/', 'PostsController@main')->name('partners');

  Route::resource('/points', 'PointsController', ['as' => 'partners']);

  Route::get('/posts', 'PostsController@index')->name('partners.posts.index');
  Route::get('/posts/{post}', 'PostsController@show')->name('partners.posts.show');
  Route::get('/posts/graphics', 'PostsController@graphics')->name('partners.posts.graphics');
});

Route::group(['namespace'=>'Admin', 'middleware'=>['auth']], function(){
  Route::resource('/admin/company', 'CompanyController', ['as' => 'admin']);
  Route::get('/admin/statistics', 'StatisticsController@view')->name('admin.statistics');
  Route::get('/partners/statistics/graphics', 'StatisticsController@graphics')->name('admin.statistics.graphics');

  Route::get('/partners/company', 'CompanyController@show')->name('partners.company.show');
  Route::get('/partners/company/{company}/edit', 'CompanyController@edit')->name('partners.company.edit');
  Route::put('/partners/company/{company}', 'CompanyController@update')->name('partners.company.update');

  Route::get('/partners/statistics', 'StatisticsController@view')->name('partners.statistics');
  Route::get('/partners/statistics/graphics', 'StatisticsController@graphics')->name('partners.statistics.graphics');
  Route::get('/partners/statistics/posts', 'StatisticsController@posts')->name('partners.statistics.posts');
});

Route::get('/auth', 'HomeController@auth')->name('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
  return redirect()->route('partners');
});
