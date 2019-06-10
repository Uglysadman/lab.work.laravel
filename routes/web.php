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

Route::get('/', function () {
    return view('main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/main', 'MainController@index')->name('main');

Route::get('/blog', 'BlogController@index')->name('blog');

Route::post('/blog/add_comment/{post_id}', 'BlogController@add_comment')->name('blog.add_comment');

Route::get('/guestBook', 'GuestBookController@index')->name('guestBook');

Route::post('/guestBook', 'GuestBookController@store')->name('guestBook.store');

Route::get('/admin', 'Admin\MainController@index')->name('admin');

Route::get('/admin/main', 'Admin\MainController@index')->name('admin.main');

Route::get('/admin/editGuestBook', 'Admin\EditGuestBookController@index')->name('admin.editGuestBook');

Route::post('/admin/editGuestBook/update/{id}', 'Admin\EditGuestBookController@update')
    ->name('admin.editGuestBook.update');

Route::post('/admin/editGuestBook/destroy/{id}', 'Admin\EditGuestBookController@destroy')
    ->name('admin.editGuestBook.destroy');

Route::get('/admin/editorBlog', 'Admin\EditorBlogController@index')->name('admin.editorBlog');

Route::post('/admin/editorBlog', 'Admin\EditorBlogController@store')->name('admin.editorBlog.store');

Route::post('/admin/editorBlog/update/{id}', 'Admin\EditorBlogController@update')
    ->name('admin.editorBlog.update');

Route::post('/admin/editorBlog/destroy/{id}', 'Admin\EditorBlogController@destroy')
    ->name('admin.editorBlog.destroy');