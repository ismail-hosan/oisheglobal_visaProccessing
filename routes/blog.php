<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Backend'],
    function () {
        // Inventory setup crud start
        Route::group(
            ['middleware' => ['web', 'auth'], 'namespace' => 'Blog'],
            function () {
                //category crud operation start
                Route::get('/blogs', 'BlogController@index')->name('blog.index');
                Route::get('/blogprocessing', 'BlogController@blogprocessing')->name('blog.blogprocessing');
                Route::get('/blog/create', 'BlogController@create')->name('blog.create');
                Route::post('/blog/store', 'BlogController@store')->name('blog.store');
                Route::get('/blog/{id}/edit', 'BlogController@edit')->name('blog.edit');
                Route::post('/blog/{id}/update', 'BlogController@update')->name('blog.update');
                Route::get('/blog/{id}/delete', 'BlogController@destroy')->name('blog.destroy');
                Route::get('/blog-status/{id}/{status}', 'BlogController@statusUpdate')->name('blog.status');
                //category crud operation end
            }
        );
        // Aboutus setup crud end
    }
);
