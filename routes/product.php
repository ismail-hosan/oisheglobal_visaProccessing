<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Backend'],
    function () {
        // Inventory setup crud start
        Route::group(
            ['middleware' => ['web', 'auth'], 'namespace' => 'Products'],
            function () {
                //category crud operation start
                Route::get('/products-list', 'ProductController@index')->name('products.index');
                Route::get('/dataProcessingProduct', 'ProductController@dataProcessingProduct')->name('products.dataProcessingProduct');
                Route::get('/products-create', 'ProductController@create')->name('products.create');
                Route::post('/products-store', 'ProductController@store')->name('products.store');
                Route::get('/products-edit/{id}', 'ProductController@edit')->name('products.edit');
                Route::post('/products-update/{id}', 'ProductController@update')->name('products.update');
                Route::get('/products-status/{id}/{status}', 'ProductController@statusUpdate')->name('products.status');
                Route::get('/products-delete/{id}', 'ProductController@destroy')->name('products.destroy');
                //category crud operation end
            }
        );
        // product setup crud end
    }
);
