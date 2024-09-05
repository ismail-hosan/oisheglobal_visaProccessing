<?php

use Illuminate\Support\Facades\Route;

// Route::get('/dest', function(){
//     Artisan::call("optimize");
// });

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Team'], function () {
        Route::get('/team-team-list', 'OurTeamController@index')->name('team.team.index');
        Route::get('/dataProcessingTeam', 'OurTeamController@dataProcessingTeam')->name('team.team.dataProcessingTeam');
        Route::get('/team-team-create', 'OurTeamController@create')->name('team.team.create');
        Route::post('/team-team-store', 'OurTeamController@store')->name('team.team.store');
        Route::get('/team-team-edit/{id}', 'OurTeamController@edit')->name('team.team.edit');
        Route::get('/team-team-show/{id}', 'OurTeamController@show')->name('team.team.show');
        Route::post('/team-team-update/{id}', 'OurTeamController@update')->name('team.team.update');
        Route::get('/team-team-delete/{id}', 'OurTeamController@destroy')->name('team.team.destroy');
        Route::get('/team-team-status/{id}/{status}', 'OurTeamController@statusUpdate')->name('team.team.status');
        
        
                
        //Designation operation start
        Route::get('/designation/index', 'DesignationController@index')->name('designation.index');
        Route::get('/dataProcessinDes', 'DesignationController@dataProcessinDes')->name('designation.dataProcessingDes');
        Route::get('/designation/create', 'DesignationController@create')->name('designation.create');
        Route::post('/designation/store', 'DesignationController@store')->name('designation.store');
        Route::get('/designation/edit/{id}', 'DesignationController@edit')->name('designation.edit');
        Route::get('/designation/show/{id}', 'DesignationController@show')->name('designation.show');
        Route::post('/designation/update/{id}', 'DesignationController@update')->name('designation.update');
        Route::get('/designation/destroy/{id}', 'DesignationController@destroy')->name('designation.destroy');
        Route::get('/designation/statusUpdate/{id}/{status}', 'DesignationController@statusUpdate')->name('designation.status');
        //Designation operation end
    });
});
