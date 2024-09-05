
<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Team'], function () {
        Route::get('/expertises-expertises-list', 'ExpertiseController@index')->name('expertises.expertises.index');
        Route::get('/dataProcessingTeamExpertises', 'ExpertiseController@dataProcessingExpertises')->name('expertises.expertises.dataProcessingExpertises');
        Route::get('/expertises-expertises-create', 'ExpertiseController@create')->name('expertises.expertises.create');
        Route::post('/expertises-expertises-store', 'ExpertiseController@store')->name('expertises.expertises.store');
        Route::get('/expertises-expertises-edit/{id}', 'ExpertiseController@edit')->name('expertises.expertises.edit');
        Route::get('/expertises-expertises-show/{id}', 'ExpertiseController@show')->name('expertises.expertises.show');
        Route::post('/expertises-expertises-update/{id}', 'ExpertiseController@update')->name('expertises.expertises.update');
        Route::get('/expertises-expertises-delete/{id}', 'ExpertiseController@destroy')->name('expertises.expertises.destroy');
        Route::get('/expertises-expertises-status/{id}/{status}', 'ExpertiseController@statusUpdate')->name('expertises.expertises.status');
    });
});
