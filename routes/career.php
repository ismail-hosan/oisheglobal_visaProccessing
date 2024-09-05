<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Backend'],
    function () {
        // Inventory setup crud start
        Route::group(
            ['middleware' => ['web', 'auth'], 'namespace' => 'Career'],
            function () {
                //category crud operation start
                Route::get('/careers', 'CareerController@index')->name('career.index');
                Route::get('/careerprocessing', 'CareerController@careerprocessing')->name('career.careerprocessing');
                Route::get('/career/create', 'CareerController@create')->name('career.create');
                Route::post('/career/store', 'CareerController@store')->name('career.store');
                Route::get('/career/{id}/edit', 'CareerController@edit')->name('career.edit');
                Route::post('/career/{id}/update', 'CareerController@update')->name('career.update');
                Route::get('/career/{id}/delete', 'CareerController@destroy')->name('career.destroy');
                Route::get('/career-status/{id}/{status}', 'CareerController@statusUpdate')->name('career.status');
                //category crud operation end
            }
        );
        // Aboutus setup crud end
    }
);
