<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Category'], function () {

        Route::get('/service-service-list', 'ServiceController@index')->name('service.service.index');
        Route::get('/dataProcessingService', 'ServiceController@dataProcessingService')->name('service.service.dataProcessingService');
        Route::get('/service-service-create', 'ServiceController@create')->name('service.service.create');
        Route::post('/service-service-store', 'ServiceController@store')->name('service.service.store');
        Route::get('/service-service-edit/{id}', 'ServiceController@edit')->name('service.service.edit');
        Route::get('/service-service-show/{id}', 'ServiceController@show')->name('service.service.show');
        Route::post('/service-service-update/{id}', 'ServiceController@update')->name('service.service.update');
        Route::get('/service-service-delete/{id}', 'ServiceController@destroy')->name('service.service.destroy');
        Route::get('/service-service-status/{id}/{status}', 'ServiceController@statusUpdate')->name('service.service.status');
    });
});
