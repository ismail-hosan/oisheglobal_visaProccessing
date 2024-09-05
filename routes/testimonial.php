<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Testimonial'], function () {
        Route::get('/testimonial-testimonial-list', 'TestimonialController@index')->name('testimonial.testimonial.index');
        Route::get('/dataProcessingTestimonial', 'TestimonialController@dataProcessingTestimonial')->name('testimonial.testimonial.dataProcessingTestimonial');
        Route::get('/testimonial-testimonial-create', 'TestimonialController@create')->name('testimonial.testimonial.create');
        Route::post('/testimonial-testimonial-store', 'TestimonialController@store')->name('testimonial.testimonial.store');
        Route::get('/testimonial-testimonial-edit/{id}', 'TestimonialController@edit')->name('testimonial.testimonial.edit');
        Route::get('/testimonial-testimonial-show/{id}', 'TestimonialController@show')->name('testimonial.team.show');
        Route::post('/testimonial-testimonial-update/{id}', 'TestimonialController@update')->name('testimonial.testimonial.update');
        Route::get('/testimonial-testimonial-delete/{id}', 'TestimonialController@destroy')->name('testimonial.testimonial.destroy');
        Route::get('/testimonial-testimonial-status/{id}/{status}', 'TestimonialController@statusUpdate')->name('testimonial.testimonial.status');
    });
});
