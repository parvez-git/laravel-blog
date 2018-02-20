<?php

Route::get('/', [

    'uses'  => 'BlogController@index',
    'as'    => 'blog'
]);

Route::get('/blog/{post}', [

    'uses'  => 'BlogController@show',
    'as'    => 'blog.show'
]);


Auth::routes();

Route::get('home', 'HomeController@index')->name('dashboard');
Route::get('post/create', 'HomeController@create')->name('post.create');
Route::post('post', 'HomeController@store')->name('post.store');
Route::get('post/{id}/edit', 'HomeController@edit')->name('post.edit');
Route::put('post/{id}', 'HomeController@update')->name('post.update');
Route::delete('post/{id}', 'HomeController@destroy')->name('post.destroy');

Route::resource('category', 'CategoryController', ['except' => ['show']] );
Route::resource('comment', 'CommentsController', ['only' => ['store']] );
