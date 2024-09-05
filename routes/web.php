<?php

// use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Backend\Project\ComplitedController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Slider\SliderController;
use App\Http\Controllers\CustomerLoginController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return "success";
});

Route::get('/navmenu', function () {
    Artisan::call('navEmpty');
    return "success";
});




Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {

    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Dashboard'], function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Settings'], function () {

        //branch crud operation start
        // Route::get('/settings-branch-list', 'BranchController@index')->name('settings.branch.index');
        // Route::get('/dataProcessingBranch', 'BranchController@dataProcessingBranch')->name('settings.branch.dataProcessingBranch');
        // Route::get('/settings-branch-create', 'BranchController@create')->name('settings.branch.create');
        // Route::post('/settings-branch-store', 'BranchController@store')->name('settings.branch.store');
        // Route::get('/settings-branch-edit/{id}', 'BranchController@edit')->name('settings.branch.edit');
        // Route::get('/settings-branch-show/{id}', 'BranchController@show')->name('settings.branch.show');
        // Route::post('/settings-branch-update/{id}', 'BranchController@update')->name('settings.branch.update');
        // Route::get('/settings-branch-delete/{id}', 'BranchController@destroy')->name('settings.branch.destroy');
        // Route::get('/settings-branch-status/{id}/{status}', 'BranchController@statusUpdate')->name('settings.branch.status');
        //branch crud operation end

        //store crud operation start
        // Route::get('/settings-store-list', 'StoreController@index')->name('settings.store.index');
        // Route::get('/dataProcessingStore', 'StoreController@dataProcessingStore')->name('settings.store.dataProcessingStore');
        // Route::get('/settings-store-create', 'StoreController@create')->name('settings.store.create');
        // Route::post('/settings-store-store', 'StoreController@store')->name('settings.store.store');
        // Route::get('/settings-store-edit/{id}', 'StoreController@edit')->name('settings.store.edit');
        // Route::get('/settings-store-show/{id}', 'StoreController@show')->name('settings.store.show');
        // Route::post('/settings-store-update/{id}', 'StoreController@update')->name('settings.store.update');
        // Route::get('/settings-store-delete/{id}', 'StoreController@destroy')->name('settings.store.destroy');
        // Route::get('/settings-store-status/{id}/{status}', 'StoreController@statusUpdate')->name('settings.store.status');
        //store crud operation end

        //navigation crud operation start
        Route::get('/navigation', 'NavigationController@index')->name('setup.index');
        Route::get('/navigation-add', 'NavigationController@create')->name('setup.create');
        Route::post('/navigation-store', 'NavigationController@store')->name('setup.store');
        Route::get('/navigation-edit/{id}', 'NavigationController@edit')->name('setup.edit');
        Route::post('/navigation-edit/{id}', 'NavigationController@update')->name('setup.update');
        Route::delete('/navigation-delete/{id}', 'NavigationController@destroy')->name('setup.destroy');
        //navigation crud operation start

        //smpt crud operation start
        Route::get('/settings-smpt-list', 'SmtpController@index')->name('settings.smpt.index');
        Route::get('/dataProcessingSmpt', 'SmtpController@dataProcessingSmpt')->name('settings.smpt.dataProcessingSmpt');
        Route::get('/settings-smpt-create', 'SmtpController@create')->name('settings.smpt.create');
        Route::post('/settings-smpt-store', 'SmtpController@store')->name('settings.smpt.store');
        Route::get('/settings-smpt-edit/{id}', 'SmtpController@edit')->name('settings.smpt.edit');
        Route::get('/settings-smpt-show/{id}', 'SmtpController@show')->name('settings.smpt.show');
        Route::post('/settings-smpt-update/{id}', 'SmtpController@update')->name('settings.smpt.update');
        Route::get('/settings-smpt-delete/{id}', 'SmtpController@destroy')->name('settings.smpt.destroy');
        Route::get('/settings-smpt-status/{id}/{status}', 'SmtpController@statusUpdate')->name('settings.smpt.status');

        //Currency crud operation start
        // Route::get('/settings-currency-list', 'CurrencyController@index')->name('settings.currency.index');
        // Route::get('/dataProcessingCurrency', 'CurrencyController@dataProcessingCurrency')->name('settings.currency.dataProcessingCurrency');
        // Route::get('/settings-currency-create', 'CurrencyController@create')->name('settings.currency.create');
        // Route::post('/settings-currency-store', 'CurrencyController@store')->name('settings.currency.store');
        // Route::get('/settings-currency-edit/{id}', 'CurrencyController@edit')->name('settings.currency.edit');
        // Route::get('/settings-currency-show/{id}', 'CurrencyController@show')->name('settings.currency.show');
        // Route::post('/settings-currency-update/{id}', 'CurrencyController@update')->name('settings.currency.update');
        // Route::get('/settings-currency-delete/{id}', 'CurrencyController@destroy')->name('settings.currency.destroy');
        // Route::get('/settings-currency-status/{id}/{status}', 'CurrencyController@statusUpdate')->name('settings.currency.status');
        //Currency crud operation end

      

        //company crud operation start
        Route::get('/settings-company-list', 'CompanyController@index')->name('settings.company.index');
        Route::get('/dataProcessingCompany', 'CompanyController@dataProcessingCompany')->name('settings.company.dataProcessingCompany');
        Route::get('/settings-company-create', 'CompanyController@create')->name('settings.company.create');
        Route::post('/settings-company-store', 'CompanyController@store')->name('settings.company.store');
        Route::get('/settings-company-edit/{id}', 'CompanyController@edit')->name('settings.company.edit');
        Route::get('/settings-company-show/{id}', 'CompanyController@show')->name('settings.company.show');
        Route::post('/settings-company-update/{id}', 'CompanyController@update')->name('settings.company.update');
        Route::get('/settings-company-delete/{id}', 'CompanyController@destroy')->name('settings.company.destroy');
        Route::get('/settings-company-status/{id}/{status}', 'CompanyController@statusUpdate')->name('settings.company.status');
        //company crud operation end

        //fiscal_year crud operation start
        Route::get('/settings-fiscal_year-list', 'FiscalYearController@index')->name('settings.fiscal_year.index');
        Route::get('/dataProcessingFiscalYear', 'FiscalYearController@dataProcessingFiscalYear')->name('settings.fiscal_year.dataProcessingFiscalYear');
        Route::get('/settings-fiscal_year-create', 'FiscalYearController@create')->name('settings.fiscal_year.create');
        Route::post('/settings-fiscal_year-store', 'FiscalYearController@store')->name('settings.fiscal_year.store');
        Route::get('/settings-fiscal_year-edit/{id}', 'FiscalYearController@edit')->name('settings.fiscal_year.edit');
        Route::get('/settings-fiscal_year-show/{id}', 'FiscalYearController@show')->name('settings.fiscal_year.show');
        Route::post('/settings-fiscal_year-update/{id}', 'FiscalYearController@update')->name('settings.fiscal_year.update');
        Route::get('/settings-fiscal_year-delete/{id}', 'FiscalYearController@destroy')->name('settings.fiscal_year.destroy');
        Route::get('/settings-fiscal_year-status/{id}/{status}', 'FiscalYearController@statusUpdate')->name('settings.fiscal_year.status');
        //fiscal_year crud operation end

        //account crud operation start
        Route::get('/settings-account-list', 'AccountsController@index')->name('settings.account.index');
        Route::get('/dataProcessingAccount', 'AccountsController@dataProcessingAccount')->name('settings.account.dataProcessingAccount');
        Route::get('/settings-account-create', 'AccountsController@create')->name('settings.account.create');
        Route::post('/settings-account-store', 'AccountsController@store')->name('settings.account.store');
        Route::get('/settings-account-edit/{id}', 'AccountsController@edit')->name('settings.account.edit');
        Route::get('/settings-account-show/{id}', 'AccountsController@show')->name('settings.account.show');
        Route::post('/settings-account-update/{id}', 'AccountsController@update')->name('settings.account.update');
        Route::get('/settings-account-delete/{id}', 'AccountsController@destroy')->name('settings.account.destroy');
        Route::get('/settings-account-status/{id}/{status}', 'AccountsController@statusUpdate')->name('settings.account.status');
        //account crud operation end
        //
        //account crud operation start
        Route::get('/settings-transfer-list', 'TransferController@index')->name('settings.transfer.index');
        Route::get('/dataProcessingBalanceTransfer', 'TransferController@dataProcessingBalanceTransfer')->name('settings.transfer.dataProcessingBalanceTransfer');
        Route::get('/settings-transfer-create', 'TransferController@create')->name('settings.transfer.create');
        Route::post('/settings-transfer-store', 'TransferController@store')->name('settings.transfer.store');
        Route::get('/settings-transfer-edit/{id}', 'TransferController@edit')->name('settings.transfer.edit');
        Route::get('/settings-transfer-show/{id}', 'TransferController@show')->name('settings.transfer.show');
        Route::post('/settings-transfer-update/{id}', 'TransferController@update')->name('settings.transfer.update');
        Route::get('/settings-transfer-delete/{id}', 'TransferController@destroy')->name('settings.transfer.destroy');
        Route::get('/settings-transfer-status/{id}/{status}', 'TransferController@statusUpdate')->name('settings.transfer.status');
        Route::get('/getAccountBalance', 'TransferController@getAccountBalance')->name('settings.transfer.checkBalance');
        //account crud operation end

        //Expance       crud operation start
        Route::get('/settings-expense-list', 'ExpenseController@index')->name('settings.expense.index');
        Route::get('/dataProcessingExpense', 'ExpenseController@dataProcessingExpense')->name('settings.expense.dataProcessingExpense');
        Route::get('/settings-expense-create', 'ExpenseController@create')->name('settings.expense.create');
        Route::get('/settings-expense-accountsearch', 'ExpenseController@accountsearch')->name('settings.expense.accountsearch');
        Route::post('/settings-expense-store', 'ExpenseController@store')->name('settings.expense.store');
        Route::get('/settings-expense-edit/{id}', 'ExpenseController@edit')->name('settings.expense.edit');
        Route::get('/settings-expense-show/{id}', 'ExpenseController@show')->name('settings.expense.show');
        Route::post('/settings-expense-update/{id}', 'ExpenseController@update')->name('settings.expense.update');
        Route::get('/settings-expense-delete/{id}', 'ExpenseController@destroy')->name('settings.expense.destroy');
        Route::get('/settings-expense-status/{id}/{status}', 'ExpenseController@statusUpdate')->name('settings.expense.status');
        Route::get('/getSubCategory', 'ExpenseController@getSubCategory')->name('settings.expense.getSubCategory');
        //account crud operation end

        //Expance category crud operation start
        Route::get('/settings-category-list', 'ExpenseCategoryController@index')->name('settings.category.index');
        Route::get('/dataProcessingExpensecategory', 'ExpenseCategoryController@dataProcessingExpensecategory')->name('settings.category.dataProcessingExpensecategory');
        Route::get('/settings-category-create', 'ExpenseCategoryController@create')->name('settings.category.create');
        Route::post('/settings-category-store', 'ExpenseCategoryController@store')->name('settings.category.store');
        Route::get('/settings-category-edit/{id}', 'ExpenseCategoryController@edit')->name('settings.category.edit');
        // Route::get('/settings-category-show/{id}', 'ExpenseCategoryController@show')->name('settings.category.show');
        Route::post('/settings-category-update/{id}', 'ExpenseCategoryController@update')->name('settings.category.update');
        Route::get('/settings-category-delete/{id}', 'ExpenseCategoryController@destroy')->name('settings.category.destroy');
        Route::get('/settings-category-status/{id}/{status}', 'ExpenseCategoryController@statusUpdate')->name('settings.category.status');
        //Expance crud operation end

        //opening balance crud operation start
        Route::get('/settings-openingbalance-list', 'OpeningController@index')->name('settings.openingbalance.index');
        Route::get('/dataProcessingOpeningBalance', 'OpeningController@dataProcessingOpeningBalance')->name('settings.openingbalance.dataProcessingOpeningBalance');
        Route::get('/settings-openingbalance-create', 'OpeningController@create')->name('settings.openingbalance.create');
        Route::post('/settings-openingbalance-store', 'OpeningController@store')->name('settings.openingbalance.store');
        Route::get('/settings-openingbalance-edit/{id}', 'OpeningController@edit')->name('settings.openingbalance.edit');
        Route::get('/settings-openingbalance-show/{id}', 'OpeningController@show')->name('settings.openingbalance.show');
        Route::post('/settings-openingbalance-update/{id}', 'OpeningController@update')->name('settings.openingbalance.update');
        Route::get('/settings-openingbalance-delete/{id}', 'OpeningController@destroy')->name('settings.openingbalance.destroy');
        Route::get('/settings-openingbalance-status/{id}/{status}', 'OpeningController@statusUpdate')->name('settings.openingbalance.status');
        Route::get('/getAllAccountHead', 'OpeningController@getAllAccountHead')->name('settings.openingbalance.getAllAccountHead');
        //opening balance crud operation end

        //customer opening balance crud operation start
        Route::get('/settings-customerOpening-list', 'CustomerOpeningController@index')->name('settings.customerOpening.index');
        Route::get('/dataProcessingCustomerOpening', 'CustomerOpeningController@dataProcessingOpeningBalance')->name('settings.customerOpening.dataProcessingCustomerOpening');
        Route::get('/settings-customerOpening-create', 'CustomerOpeningController@create')->name('settings.customerOpening.create');
        Route::post('/settings-customerOpening-store', 'CustomerOpeningController@store')->name('settings.customerOpening.store');
        Route::get('/settings-customerOpening-edit/{id}', 'CustomerOpeningController@edit')->name('settings.customerOpening.edit');
        Route::get('/settings-customerOpening-show/{id}', 'CustomerOpeningController@show')->name('settings.customerOpening.show');
        Route::post('/settings-customerOpening-update/{id}', 'CustomerOpeningController@update')->name('settings.customerOpening.update');
        Route::get('/settings-customerOpening-delete/{id}', 'CustomerOpeningController@destroy')->name('settings.customerOpening.destroy');
        Route::get('/settings-customerOpening-status/{id}/{status}', 'CustomerOpeningController@statusUpdate')->name('settings.customerOpening.status');
        //customer opening balance crud operation end
    });

    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Usermanage'], function () {
        //admin role operation start
        Route::get('/usermanage-userRole-list', 'UserRoleController@index')->name('usermanage.userRole.index');
        Route::get('/dataProcessingUserRole', 'UserRoleController@dataProcessinguserRole')->name('usermanage.userRole.dataProcessingRole');
        Route::get('/usermanage-userRole-create', 'UserRoleController@create')->name('usermanage.userRole.create');
        Route::post('/usermanage-userRole-store', 'UserRoleController@store')->name('usermanage.userRole.store');
        Route::get('/usermanage-userRole-edit/{id}', 'UserRoleController@edit')->name('usermanage.userRole.edit');
        Route::get('/usermanage-userRole-show/{id}', 'UserRoleController@show')->name('usermanage.userRole.show');
        Route::post('/usermanage-userRole-update/{id}', 'UserRoleController@update')->name('usermanage.userRole.update');
        Route::get('/usermanage-userRole-delete/{id}', 'UserRoleController@destroy')->name('usermanage.userRole.destroy');
        Route::get('/usermanage-userRole-status/{id}/{status}', 'UserRoleController@statusUpdate')->name('usermanage.userRole.status');
        //admin role operation end

        //user role operation start
        Route::get('/usermanage-user-list', 'UserController@index')->name('usermanage.user.index');
        Route::get('/dataProcessingUser', 'UserController@dataProcessinguser')->name('usermanage.user.dataProcessingUser');
        Route::get('/usermanage-user-create', 'UserController@create')->name('usermanage.user.create');
        Route::post('/usermanage-user-store', 'UserController@store')->name('usermanage.user.store');
        Route::get('/usermanage-user-edit/{id}', 'UserController@edit')->name('usermanage.user.edit');
        Route::get('/usermanage-user-show/{id}', 'UserController@show')->name('usermanage.user.show');
        Route::post('/usermanage-user-update/{id}', 'UserController@update')->name('usermanage.user.update');
        Route::get('/usermanage-user-delete/{id}', 'UserController@destroy')->name('usermanage.user.destroy');
        Route::get('/usermanage-user-status/{id}/{status}', 'UserController@statusUpdate')->name('usermanage.user.status');
        //user role operation end 

        // slider image 

        
        
    });
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Slider'], function () {
        Route::get('/settings-slider-list', 'SliderController@index')->name('settings.slider.index');
        Route::post('/settings-slider-stores', 'SliderController@store')->name('settings.sliders.store');
        Route::get('/dataProcessingSlider','SliderController@dataProcessingSlider')->name('slider.dataprocessingSlider');
        Route::get('/createSlider','SliderController@create')->name('slider.createSlider');
        Route::get('/editSlider/{id}','SliderController@edit')->name('slider.edit');
        Route::post('/updateSlider/{id}','SliderController@update')->name('slider.update');
        Route::get('/sliders-status/{id}/{status}', 'SliderController@statusUpdate')->name('slider.status');
        Route::get('/slider-delete/{id}', 'SliderController@destroy')->name('slider.destroy');

    });


    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Project'], function () {
        Route::get('/project-list', 'ProjectController@index')->name('project.index');
        Route::post('/ongoing-project-store', 'ProjectController@store')->name('project.store');
        Route::get('/dataProcessingProject','ProjectController@dataProcessingProject')->name('project.dataprocessingProject');
        Route::get('/project-create','ProjectController@create')->name('project.create');
        Route::get('/project-edit/{id}','ProjectController@edit')->name('project.edit');
        Route::post('/project/{id}','ProjectController@update')->name('project.update');
        Route::get('/project-show/{id}/{status}', 'ProjectController@show')->name('project.show');
        Route::get('/project-delete/{id}', 'ProjectController@destroy')->name('project.destroy');

    });

    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Project'], function () {
        Route::get('/project-image-list', 'PimageController@index')->name('project.image.index');
        Route::post('/settings-slider-store', 'PimageController@store')->name('project.image.store');
        Route::get('/dataProcessingprojectImage','PimageController@dataProcessingProjectImage')->name('project.image.process');
        Route::get('/project-image/create','PimageController@create')->name('project.image.create');
        Route::get('/project-image/{id}','PimageController@edit')->name('project.image.edit');
        Route::post('/project-image/{id}','PimageController@update')->name('project.image.update');
        Route::get('/project-image/{id}/{status}', 'PimageController@statusUpdate')->name('project.image.status');
        Route::get('/project-image-delete/{id}', 'PimageController@destroy')->name('project.image.destroy');

    });
     Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Gallery'], function () {
        Route::get('/photos-list', 'PhotoController@index')->name('photos.index');
        Route::post('/photos-store', 'PhotoController@store')->name('photos.store');
        Route::get('/dataProcessingPhotos','PhotoController@dataProcessingPhotos')->name('photos.dataprocessingPhotos');
        Route::get('/photos-create','PhotoController@create')->name('photos.create');
        Route::get('/photos-edit/{id}','PhotoController@edit')->name('photos.edit');
        Route::post('/photos/{id}','PhotoController@update')->name('photos.update');
        Route::get('/photos-show/{id}/{status}', 'PhotoController@show')->name('photos.show');
        Route::get('/photos-delete/{id}', 'PhotoController@destroy')->name('photos.destroy');

    });

    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Gallery'], function () {
        Route::get('/videos-list', 'VideoController@index')->name('videos.index');
        Route::post('/videos-store', 'VideoController@store')->name('videos.store');
        Route::get('/dataProcessingVideos','VideoController@dataProcessingVideos')->name('videos.dataprocessingProject');
        Route::get('/videos-create','VideoController@create')->name('videos.create');
        Route::get('/videos-edit/{id}','VideoController@edit')->name('videos.edit');
        Route::post('/videos/{id}','VideoController@update')->name('videos.update');
        Route::get('/videos-show/{id}/{status}', 'VideoController@show')->name('videos.show');
        Route::get('/videos-delete/{id}', 'VideoController@destroy')->name('videos.destroy');
    });
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Agent'], function () {
          //Agent crud operation start
          Route::get('/settings-agent-list', 'AgentController@index')->name('agent.index');
          Route::get('/dataProcessingagents', 'AgentController@dataProcessingAgent')->name('agent.dataProcessingAgent');
          Route::get('/settings-agent-create', 'AgentController@create')->name('agent.create');
          Route::post('/settings-agent-store', 'AgentController@store')->name('agent.store');
          Route::get('/settings-agent-edit/{id}', 'AgentController@edit')->name('agent.edit');
          Route::get('/settings-agent-show/{id}', 'AgentController@show')->name('agent.show');
          Route::post('/settings-agent-update/{id}', 'AgentController@update')->name('agent.update');
          Route::get('/settings-agent-delete/{id}', 'AgentController@destroy')->name('agent.destroy');
          Route::get('/settings-agent-status/{id}/{status}', 'AgentController@statusUpdate')->name('agent.status');
          //Agent crud operation end
    });

    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Visa'], function () {
        //Agent crud operation start
        Route::get('/visaproccesing-list', 'VisaProcessingController@index')->name('visaproccesing.index');
        Route::get('/dataProcessingagentd', 'VisaProcessingController@dataProcessingVisa')->name('visaproccesing.dataProcessingVisa');
        Route::get('/visaproccesing-create', 'VisaProcessingController@create')->name('visaproccesing.create');
        Route::post('/visaproccesing-store', 'VisaProcessingController@store')->name('visaproccesing.store');
        Route::get('/visaproccesing-edit/{id}', 'VisaProcessingController@edit')->name('visaproccesing.edit');
        Route::get('/visaproccesing-show/{id}', 'VisaProcessingController@show')->name('visaproccesing.show');
        Route::post('/visaproccesing-update/{id}', 'VisaProcessingController@update')->name('visaproccesing.update');
        Route::get('/visaproccesing-delete/{id}', 'VisaProcessingController@destroy')->name('visaproccesing.destroy');
        Route::get('/visaproccesing-status/{id}/{status}', 'VisaProcessingController@statusUpdate')->name('visaproccesing.status');
        //Agent crud operation end
  });
  
   Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Branch'], function () {
        //Agent crud operation start
        Route::get('/barnch-user-list', 'BaranchUserController@index')->name('barnch-user-list.index');
        Route::get('/dataProcessingVisa', 'BaranchUserController@dataProcessingBranch')->name('barnch-user-list.dataProcessingBranch');
        Route::get('/barnch-user-list-create', 'BaranchUserController@create')->name('barnch-user-list.create');
        Route::post('/barnch-user-list-store', 'BaranchUserController@store')->name('barnch-user-list.store');
        Route::get('/barnch-user-list-edit/{id}', 'BaranchUserController@edit')->name('barnch-user-list.edit');
        Route::get('/barnch-user-list-show/{id}', 'BaranchUserController@show')->name('barnch-user-list.show');
        Route::post('/barnch-user-list-update/{id}', 'BaranchUserController@update')->name('barnch-user-list.update');
        Route::get('/barnch-user-list-delete/{id}', 'BaranchUserController@destroy')->name('barnch-user-list.destroy');
        Route::get('/barnch-user-list-status/{id}/{status}', 'BaranchUserController@statusUpdate')->name('barnch-user-list.status');
        //Agent crud operation end
    });
    Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Application'], function () {
        //Agent crud operation start
        Route::get('/agent/application-list', 'ApplicationController@agent')->name('agent.application-list.index');
        Route::get('/application-list', 'ApplicationController@index')->name('application-list.index');
        Route::get('/dataProcessingApplication', 'ApplicationController@dataProcessingApplication')->name('application-list.dataProcessingApplication');
        Route::get('/application-create', 'ApplicationController@create')->name('application-list.create');
        Route::post('/application-store', 'ApplicationController@store')->name('application-list.store');
        Route::get('/application-edit/{id}', 'ApplicationController@edit')->name('application-list.edit');
        Route::get('/application-show/{id}', 'ApplicationController@show')->name('application-list.show');
        Route::post('/application-update/{id}', 'ApplicationController@update')->name('application-list.update');
        Route::get('/application-delete/{id}', 'ApplicationController@destroy')->name('application-list.destroy');
        Route::post('/application-status/{id}', 'ApplicationController@statusUpdate')->name('application-list.status');
        Route::get('/application-data-user', 'ApplicationController@index_user')->name('application-data-user.index');
        Route::get('/dataProcessingUser', 'ApplicationController@dataProcessingUser')->name('application-list.dataProcessingUser');
        Route::get('/application-edit-agent/{id}', 'ApplicationController@agentedit')->name('application-list.agentedit');
        Route::post('/application-update-agent/{id}', 'ApplicationController@agentupdate')->name('application-list.agentupdate');
        
        //Agent crud operation end
    });

    
   
    
    
});



    Route::group(['middleware' => ['web', 'auth']],function(){
        
        Route::get('/admin/google-api-index/create', 'GoogleApiIndexingController@create')->name('indexing.create');
        Route::post('/admin/google-api-index/store', 'GoogleApiIndexingController@store')->name('indexing.store');
        
    });