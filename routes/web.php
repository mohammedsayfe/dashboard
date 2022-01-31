<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ExpensController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\SettingController;
//use App\Http\Controllers\SalseController;



Auth::routes();
Route::get('/', function () {return view('front.index');})->name('home');
//Route::get('/test',[TestController::class,'index']);


Route::prefix('admin')->middleware(['auth','CheckRole:ADMIN','ActiveAccount'])->name('admin.')->group(function () {
    Route::get('/',[AdminController::class,'index'])->name('index');

    Route::resource('members',\App\Http\Controllers\MemberController::class);

    //Route::get('/profile',[AdminController::class,'upload_image']);

    Route::resource('articles',ArticleController::class);
    Route::prefix('upload')->name('upload.')->group(function(){
        Route::post('/image',[HelperController::class,'upload_image'])->name('image');
        Route::post('/file',[HelperController::class,'upload_file'])->name('file');
        Route::post('/remove-file',[HelperController::class,'remove_files'])->name('remove-file');
    });



    #########################  product   ########################
    Route::group(['prefix' => 'product'], function () {
        Route::get('/',[ProductController::class,'index']) -> name('all.product');
        Route::get('create',[ProductController::class,'create']) -> name('product.create');
        Route::post('store',[ProductController::class,'store']) -> name('product.store');
        Route::get('edit/{id}',[ProductController::class,'edit']) -> name('product.edit');
        Route::get('print/',[ProductController::class,'print']) -> name('product.print');
        Route::post('update/{product}',[ProductController::class,'update']) -> name('product.update');
        Route::get('delete/{id}',[ProductController::class,'delete']) -> name('product.delete');
    });
    ######################### End  product Routes  ########################



    #########################  assest   ########################
    Route::group(['prefix' => 'assest'], function () {
        Route::get('/',[AssetsController::class,'index']) -> name('all.assest');
        Route::get('create',[AssetsController::class,'create']) -> name('assest.create');
        Route::post('store',[AssetsController::class,'store']) -> name('assest.store');
        Route::get('edit/{id}',[AssetsController::class,'edit']) -> name('assest.edit');
        Route::get('print/',[AssetsController::class,'print']) -> name('assest.print');
        Route::post('update/{assets}',[AssetsController::class,'update']) -> name('assest.update');
        Route::get('delete/{id}',[AssetsController::class,'delete']) -> name('assest.delete');
    });
    ######################### End  branches Routes  ########################

    #########################  expens   ########################
    Route::group(['prefix' => 'expens'], function () {
        Route::get('/',[ExpensController::class,'index']) -> name('all.expens');
        Route::get('create',[ExpensController::class,'create']) -> name('expens.create');
        Route::post('store',[ExpensController::class,'store']) -> name('expens.store');
        Route::get('edit/{id}',[ExpensController::class,'edit']) -> name('expens.edit');
        Route::get('print/',[ExpensController::class,'print']) -> name('expens.print');
        Route::POST('update/{expens}',[ExpensController::class,'update']) -> name('expens.update');
        Route::get('delete/{id}',[ExpensController::class,'delete']) -> name('expens.delete');
    });
    ######################### End  branches Routes  ########################


    ######################### begin Bank Route   ########################
    Route::group(['prefix' => 'bank'], function () {
        Route::get('/',[BankController::class,'index']) -> name('all.bank');
        Route::get('create',[BankController::class,'create']) -> name('bank.create');
        Route::post('store',[BankController::class,'store']) -> name('bank.store');
        Route::get('edit/{id}',[BankController::class,'edit']) -> name('bank.edit');
        Route::get('print/',[BankController::class,'print']) -> name('bank.print');
        Route::POST('update/{bank}',[BankController::class,'update']) -> name('bank.update');
        Route::get('delete/{id}',[BankController::class,'delete']) -> name('bank.delete');
    });
    ######################### end Bank Route  ########################



  ######################### begin account Route   ########################
    Route::group(['prefix' => 'account'], function () {
        Route::get('/',[AccountController::class,'index']) -> name('all.account');
        Route::get('create',[AccountController::class,'create']) -> name('account.create');
        Route::post('store',[AccountController::class,'store']) -> name('account.store');
        Route::get('edit/{id}',[AccountController::class,'edit']) -> name('account.edit');
        Route::get('print/',[AccountController::class,'print']) -> name('account.print');
        Route::POST('update/{account}',[AccountController::class,'update']) -> name('account.update');
        Route::get('delete/{id}',[AccountController::class,'delete']) -> name('account.delete');
    });
    ######################### end account Route  ########################


    ######################### begin sales Route   ########################
    Route::group(['prefix' => 'sales'], function () {
        Route::get('/',[\App\Http\Controllers\SalseController::class,'index']) -> name('all.sales');
        Route::get('create',[\App\Http\Controllers\SalseController::class,'create']) -> name('sales.create');
        Route::post('store',[\App\Http\Controllers\SalseController::class,'store']) -> name('sales.store');
        Route::get('edit/{id}',[\App\Http\Controllers\SalseController::class,'edit']) -> name('sales.edit');
        Route::get('print/',[\App\Http\Controllers\SalseController::class,'print']) -> name('sales.print');
        Route::POST('update/{sale}',[\App\Http\Controllers\SalseController::class,'update']) -> name('sales.update');
        Route::get('delete/{id}',[\App\Http\Controllers\SalseController::class,'delete']) -> name('sales.delete');
    });
    ######################### end sales Route  ########################





    //Route::get('/profile',[AdminController::class,'upload_image']);

//    Route::resource('craete',MemberController::clas,);
    Route::prefix('upload')->name('upload.')->group(function(){
        Route::post('/image',[HelperController::class,'upload_image'])->name('image');
        Route::post('/file',[HelperController::class,'upload_file'])->name('file');
        Route::post('/remove-file',[HelperController::class,'remove_files'])->name('remove-file');
    });


    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/',[ProfileController::class,'index'])->name('index');
        Route::get('/edit',[ProfileController::class,'edit'])->name('edit');
        Route::put('/update',[ProfileController::class,'update'])->name('update');
        Route::put('/update-password',[ProfileController::class,'update_password'])->name('update-password');
        Route::put('/update-email',[ProfileController::class,'update_email'])->name('update-email');
    });
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/',[NotificationsController::class,'index'])->name('index');
        Route::get('/ajax',[NotificationsController::class,'notifications_ajax'])->name('ajax');
        Route::post('/see',[NotificationsController::class,'notifications_see'])->name('see');
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/',[SettingController::class,'index'])->name('index');
        Route::put('/update',[SettingController::class,'update'])->name('update');
    });
    //Route::get('member',[MemberController::Controller::class,'create'])->name('create');
});


Route::get('blocked',[HelperController::class,'blocked_user'])->name('blocked');
Route::get('robots.txt',[HelperController::class,'robots']);
Route::get('manifest.json',[HelperController::class,'manifest']);
Route::get('sitemap.xml',[SiteMapController::class,'sitemap']);
Route::get('sitemaps/{name}/{page}/sitemap.xml',[SiteMapController::class,'viewer']);
