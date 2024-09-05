<?php

use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Frontant\Ditails\DitailsDataStoreController;
use Illuminate\Support\Facades\Route;

Route::namespace('Frontant')->middleware(['web'])->group(function () {

    Route::get('/cache', function () {
        \Artisan::call('optimize:clear');

        return '/';
    });
    // Home route 
    Route::get('/', 'FrontendController@index')->name('frontend.index');
    Route::get('/ourConcern/{slug}','PagesController@concernshow')->name('ourConcern.show');

    // our client
    Route::get('/about-us/ourclient', 'FrontendController@ourclient')->name('menu.aboutus.ourclient');
    Route::get('/about-us/directorMesssge', 'FrontendController@directorMesssge')->name('menu.aboutus.directorMesssge');
    // About Us
    Route::get('/about-us', 'FrontendController@aboutus')->name('menu.aboutus');

    // Our team
    Route::get('/about-us/ourteam', 'FrontendController@ourteam')->name('menu.aboutus.ourteam');
    // mission vission
     Route::get('/about-us/mission', 'FrontendController@mission')->name('menu.aboutus.mission');
    // our Visaprocessing
    Route::get('/visaprocessing', 'FrontendController@visaService')->name('menu.visaService');
    Route::get('/visaprocessing/{slug}','PagesController@visaprocesshow')->name('visaprocessing.show');
    // testimunials
    Route::get('/about-us/testimunials', 'FrontendController@testimunials')->name('menu.aboutus.testimunials');
    // overview
    Route::get('/about-us/overview', 'FrontendController@overview')->name('menu.aboutus.overview');
    Route::get('/about-us/partnership', 'FrontendController@partnership')->name('menu.aboutus.partnership');
    Route::get('/about-us/technologies', 'FrontendController@technologies')->name('menu.aboutus.technologies');

    // contact us
    Route::get('/contact-us', 'FrontendController@contact')->name('contact.us');
    Route::post('/contactemailsend', 'FrontendController@contactemailsend')->name('contactemailsend');


    // privacy link
    Route::get('/privacy-policy', 'FrontendController@privacy')->name('menu.privacy');
    
    Route::get('/gallery/photos', 'FrontendController@photos')->name('view.photos');
    Route::get('/gallery/videos', 'FrontendController@videos')->name('view.videos');
    Route::get('/user/login', 'FrontendController@userLogin')->name('view.userlogin');
    Route::get('/user/registaion', 'FrontendController@userRegister')->name('view.useregister');
    Route::get('/branch/registaion', 'FrontendController@baranchRegister')->name('view.baranchRegister');
    Route::get('/apply/ditails/first', 'FrontendController@applyditailsfirst')->name('visa.data.first')->middleware(['web', 'auth']);

    //page routes
    // Route::get('/pages/{firstparam}', 'PagesController@firstLavelPage')->name('page.firstlavel');
    // Route::get('/pages/{firstparam}/{secondparam}', 'PagesController@secondLavelPage')->name('page.secondlavel');
    // Route::get('/pages/{firstparam}/{secondparam}/{thirdparam}', 'PagesController@thirdLavelPage')->name('page.thirdlavel');
    // Route::get('/services/{category:slug}', 'PagesController@service_categories')->name('pages.category.services');
    // Route::get('/services/{category}/{subcategory}', 'PagesController@services')->name('pages.subcategory.services');

    Route::get('/services/{slug:slug}',  'PagesController@pages')->name('pages.services');
    Route::get('/softwares/{slug:slug}',  'PagesController@softwares')->name('pages.product');
    Route::post('orderNow',  'PagesController@orderNow')->name('orderNow');
    Route::get('/careers',  'PagesController@careers')->name('careers');
    Route::get('/careers/{slug}',  'PagesController@show')->name('careers.show');
    Route::get('/blogs',  'PagesController@blogs')->name('menu.blog');
    Route::get('/blogs/{slug}',  'PagesController@blogsshow')->name('blogs.show');

    Route::get('/project/{id}/ditails','PagesController@project')->name('project.ditails');

    Route::get('/top-10-software-company-in-bangladesh',  'PagesController@blogTop10Company')->name('top_ten_products');
});

Route::post('/first/store', [DitailsDataStoreController::class, 'first'])->name('visa.first.store')->middleware(['web', 'auth']); 
Route::post('/second/store', [DitailsDataStoreController::class, 'second'])->name('visa.second.store')->middleware(['web', 'auth']);
Route::post('/therd/store', [DitailsDataStoreController::class, 'therd'])->name('visa.therd.store')->middleware(['web', 'auth']);
Route::post('/final/store', [DitailsDataStoreController::class, 'final'])->name('visa.final.store')->middleware(['web', 'auth']);
Route::post('/registration', [CustomerLoginController::class, 'registration'])->name('customer.registration')->middleware(['web']);
Route::post('/branchregistration', [CustomerLoginController::class,'branchregistration'])->name('branch.registration')->middleware(['web']);
Route::post('/login', [CustomerLoginController::class, 'login'])->name('customer.login');

Route::get('/user/dashboard', [CustomerLoginController::class, 'dashboard'])->name('customer.dashboard');