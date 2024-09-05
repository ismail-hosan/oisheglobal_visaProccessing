<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Aboutus'], function () {
        Route::get('/message-message-list', 'WelcomeMessageController@index')->name('message.message.index');
        Route::get('/dataProcessingMessage', 'WelcomeMessageController@dataProcessingMessage')->name('message.message.dataProcessingMessage');
        Route::get('/message-message-create', 'WelcomeMessageController@create')->name('message.message.create');
        Route::post('/message-message-store', 'WelcomeMessageController@store')->name('message.message.store');
        Route::get('/message-message-edit/{id}', 'WelcomeMessageController@edit')->name('message.message.edit');
        Route::get('/message-message-show/{id}', 'WelcomeMessageController@show')->name('message.message.show');
        Route::post('/message-message-update/{id}', 'WelcomeMessageController@update')->name('message.message.update');
        Route::get('/message-message-delete/{id}', 'WelcomeMessageController@destroy')->name('message.message.destroy');
        Route::get('/message-message-status/{id}/{status}', 'WelcomeMessageController@statusUpdate')->name('message.message.status');
    });
});
