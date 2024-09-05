<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Faq'], function () {
        Route::get('/faq-faq-list', 'FaqController@index')->name('faq.faq.index');
        Route::get('/dataProcessingFaq', 'FaqController@dataProcessingFaq')->name('faq.faq.dataProcessingFaq');
        Route::get('/faq-faq-create', 'FaqController@create')->name('faq.faq.create');
        Route::post('/faq-faq-store', 'FaqController@store')->name('faq.faq.store');
        Route::get('/faq-faq-edit/{id}', 'FaqController@edit')->name('faq.faq.edit');
        Route::get('/faq-faq-show/{id}', 'FaqController@show')->name('faq.faq.show');
        Route::post('/faq-faq-update/{id}', 'FaqController@update')->name('faq.faq.update');
        Route::get('/faq-faq-delete/{id}', 'FaqController@destroy')->name('faq.faq.destroy');
        Route::get('/faq-faq-status/{id}/{status}', 'FaqController@statusUpdate')->name('faq.faq.status');
    });
});
