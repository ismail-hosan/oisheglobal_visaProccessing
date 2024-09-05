<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Aboutus\OurClientController;

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Backend'],
    function () {
        // Inventory setup crud start
        Route::group(
            ['middleware' => ['web', 'auth'], 'namespace' => 'Ourclient'],
            function () {

                // Our client route started **
                Route::get('/aboutUs-ourClient-list', [OurClientController::class, 'index'])->name('aboutUs.ourClient.index');
                Route::get('/dataProcessingOurclient', [OurClientController::class, 'dataProcessingOurclient'])->name('aboutUs.ourClient.dataProcessingOurclient');
                Route::get('/aboutUs-ourClient-create', [OurClientController::class, 'create'])->name('aboutUs.ourClient.create');
                Route::post('/aboutUs-ourClient-store', [OurClientController::class, 'store'])->name('aboutUs.ourClient.store');
                Route::get('/aboutUs-ourClient-edit/{id}', [OurClientController::class, 'edit'])->name('aboutUs.ourClient.edit');
                Route::post('/aboutUs-update/{id}', [OurClientController::class, 'update'])->name('aboutUs.ourClient.update');
                Route::get('/aboutUs-ourClient-show', [OurClientController::class, 'show'])->name('aboutUs.ourClient.show');
                Route::get('/aboutUs-ourClient-status/{id}/{status}', [OurClientController::class, 'statusUpdate'])->name('aboutUs.ourClient.status');
                Route::get('/aboutUs-ourClient-destroy/{id}', [OurClientController::class, 'destroy'])->name('aboutUs.ourClient.destroy');
                // Our client route End **
            }
        );
        // Aboutus setup crud end
    }
);
