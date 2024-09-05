<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Backend'],
    function () {
        // Inventory setup crud start
        Route::group(
            ['middleware' => ['web', 'auth'], 'namespace' => 'Aboutus'],
            function () {
                //category crud operation start
                Route::get('/about-us-list', 'AboutusController@index')->name('aboutus.index');
                Route::get('/dataProcessingAboutus', 'AboutusController@dataProcessingAboutus')->name('aboutus.dataProcessingAboutus');
                Route::get('/about-us-edit/{id}', 'AboutusController@edit')->name('aboutus.edit');
                Route::post('/about-us-update/{id}', 'AboutusController@update')->name('aboutus.update');
                Route::get('/about-us-status/{id}/{status}', 'AboutusController@statusUpdate')->name('aboutus.status');
                //category crud operation end
            }
        );
        // Aboutus setup crud end
    }
);
