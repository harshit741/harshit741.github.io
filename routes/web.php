<?php

/*
|----------err----------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@getHome')->name('home');

Route::redirect('/home', '/');

Route::get('/contact', 'PagesController@getContact')->name('contact');

Route::view('/about', 'pages.about')->name('about');

Route::resource('posts','PostController');

Route::get('/category/{category}','PagesController@category');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard/{name}','PagesController@dashboard')->name('dashboard');

Route::get('/author/{author}','PagesController@author')->name('author');


?>

