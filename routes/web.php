<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

// Auth::routes();

Route::get('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');
Route::get('/create_new_password','LoginController@cnpassword')->name('cnpassword');
Route::post('/loginprocess','LoginController@loginprocess')->name('loginprocess');
Route::post('/cnpasswordprocess','LoginController@cnpasswordprocess')->name('cnpasswordprocess');

Route::get('/checklevel', 'HomeController@checklevel')->name('checklevel')->middleware('sessionlogin');
Route::get('/converter','Controller@converter');
Route::middleware(['sessionlogin','ismanagement'])->prefix('management')->group(function(){
    Route::get('/home','ManagementController@index')->name('management_home');
    Route::get('/workorder','ManagementController@workorder')->name('management_workorder');
    Route::prefix('basicinfo')->group(function(){
        Route::get('/bom','ManagementController@bom')->name('management_bom');
        Route::get('/leadtime','ManagementController@leadtime')->name('management_leadtime');
        Route::get('/routing','ManagementController@routing')->name('management_routing');
        Route::get('/line','ManagementController@line')->name('management_line');
        Route::get('/op','ManagementController@op')->name('management_op');
        Route::get('/part','ManagementController@part')->name('management_part');
        Route::get('/model','ManagementController@model')->name('management_model');
        Route::get('/size','ManagementController@size')->name('management_size');
    });
    Route::prefix('transaction')->group(function(){
        Route::get('/transaction','ManagementController@transaction')->name('management_transaction');
        Route::get('/defect','ManagementController@defect')->name('management_defect');
    });
});
Route::middleware(['sessionlogin','isqualitycontrol'])->prefix('qualitycontrol')->group(function(){
    Route::get('/home','QualityControlController@index')->name('qualitycontrol_home');
});
Route::middleware(['sessionlogin','isproduction'])->prefix('production')->group(function(){
    Route::get('/home','ProductionController@index')->name('production_home');
});
Route::middleware(['sessionlogin','isadmin'])->prefix('admin')->group(function(){
    Route::get('/home','AdminController@index')->name('admin_home');
});
