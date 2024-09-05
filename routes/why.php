<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Why'], function () {
        Route::get('/why-why-list', 'WhyChooseController@index')->name('why.why.index');
        Route::get('/dataProcessingWhy', 'WhyChooseController@dataProcessingWhy')->name('why.why.dataProcessingWhy');
        Route::get('/why-why-create', 'WhyChooseController@create')->name('why.why.create');
        Route::post('/why-why-store', 'WhyChooseController@store')->name('why.why.store');
        Route::get('/why-why-edit/{id}', 'WhyChooseController@edit')->name('why.why.edit');
        Route::get('/why-why-show/{id}', 'WhyChooseController@show')->name('why.why.show');
        Route::post('/why-why-update/{id}', 'WhyChooseController@update')->name('why.why.update');
        Route::get('/why-why-delete/{id}', 'WhyChooseController@destroy')->name('why.why.destroy');
        Route::get('/why-why-status/{id}/{status}', 'WhyChooseController@statusUpdate')->name('why.why.status');
    });
});
