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
    Route::prefix('defect')->group(function(){
        Route::get('/master','AdminController@defectmaster')->name('management_defect_master');
        Route::get('/info','ManagementController@transaction_defect_info')->name('management_defect_info');
    });
    Route::prefix('infotransaction')->group(function(){
        Route::get('/info','ManagementController@transaction_info')->name('management_transaction_info');
        Route::get('/wip','ManagementController@wip_info')->name('management_wip_info');
        Route::get('/production','ProductionController@production_info')->name('management_production_info');
    });
});
Route::middleware(['sessionlogin','isqualitycontrol'])->prefix('qualitycontrol')->group(function(){
    Route::get('/home','ManagementController@index')->name('qualitycontrol_home');
    Route::get('/workorder','ManagementController@workorder')->name('qualitycontrol_workorder');
    Route::prefix('defect')->group(function(){
        Route::get('/master','AdminController@defectmaster')->name('qualitycontrol_defect_master');
        Route::get('/info','ManagementController@transaction_defect_info')->name('qualitycontrol_defect_info');
        Route::get('/defect','ManagementController@defect')->name('qualitycontrol_defect');
    });
    Route::prefix('infotransaction')->group(function(){
        Route::get('/info','ManagementController@transaction_info')->name('qualitycontrol_transaction_info');
        Route::get('/wip','ManagementController@wip_info')->name('qualitycontrol_wip_info');
        Route::get('/production','ProductionController@production_info')->name('qualitycontrol_production_info');
    });
});
Route::middleware(['sessionlogin','isproduction'])->prefix('production')->group(function(){
    Route::get('/home','ManagementController@index')->name('production_home');
    Route::get('/workorder','ManagementController@workorder')->name('production_workorder');
    Route::prefix('transaction')->group(function(){
        Route::get('/transaction','ManagementController@transaction')->name('production_transaction');
    });
    Route::prefix('infotransaction')->group(function(){
        Route::get('/info','ManagementController@transaction_info')->name('production_transaction_info');
        Route::get('/defect','ManagementController@transaction_defect_info')->name('production_defect_info');
        Route::get('/wip','ManagementController@wip_info')->name('production_wip_info');
        Route::get('/production','ProductionController@production_info')->name('production_production_info');
    });
});
Route::middleware(['sessionlogin','isadmin'])->prefix('admin')->group(function(){
    Route::get('/home','ManagementController@index')->name('admin_home');
    Route::get('/workorder','ManagementController@workorder')->name('admin_workorder');
    Route::prefix('basicinfo')->group(function(){
        Route::get('/bom','ManagementController@bom')->name('admin_bom');
        Route::get('/leadtime','ManagementController@leadtime')->name('admin_leadtime');
        Route::get('/routing','ManagementController@routing')->name('admin_routing');
        Route::get('/line','ManagementController@line')->name('admin_line');
        Route::get('/op','ManagementController@op')->name('admin_op');
        Route::get('/part','ManagementController@part')->name('admin_part');
        Route::get('/model','ManagementController@model')->name('admin_model');
        Route::get('/size','ManagementController@size')->name('admin_size');
    });
    Route::get('/transaction','ManagementController@transaction')->name('admin_transaction');
    Route::prefix('defect')->group(function(){
        Route::get('/','ManagementController@defect')->name('admin_defect');
        Route::get('/master','AdminController@defectmaster')->name('admin_defect_master');
        Route::get('/info','ManagementController@transaction_defect_info')->name('admin_defect_info');
    });
    Route::prefix('infotransaction')->group(function(){
        Route::get('/info','ManagementController@transaction_info')->name('admin_transaction_info');
        Route::get('/wip','ManagementController@wip_info')->name('admin_wip_info');
        Route::get('/production','ProductionController@production_info')->name('admin_production_info');
    });
    Route::get('/users','AdminController@user')->name('admin_users');
});

Route::prefix('/kr')->group(function(){
    
    Route::get('/', function () {
        return redirect()->route('kr_login');
    });

    // Auth::routes();

    Route::get('/login','LoginKRController@login')->name('kr_login');
    Route::get('/logout','LoginKRController@logout')->name('kr_logout');
    Route::get('/create_new_password','LoginKRController@cnpassword')->name('kr_cnpassword');
    Route::post('/loginprocess','LoginKRController@loginprocess')->name('kr_loginprocess');
    Route::post('/cnpasswordprocess','LoginKRController@cnpasswordprocess')->name('kr_cnpasswordprocess');

    Route::get('/checklevel', 'HomeKrController@checklevel')->name('kr_checklevel')->middleware('sessionkrlogin');
    Route::middleware(['sessionkrlogin','iskrmanagement'])->prefix('management')->group(function(){
        Route::get('/home','ManagementKrController@index')->name('kr_management_home');
        Route::get('/workorder','ManagementKrController@workorder')->name('kr_management_workorder');
        Route::prefix('basicinfo')->group(function(){
            Route::get('/bom','ManagementKrController@bom')->name('kr_management_bom');
            Route::get('/leadtime','ManagementKrController@leadtime')->name('kr_management_leadtime');
            Route::get('/routing','ManagementKrController@routing')->name('kr_management_routing');
            Route::get('/line','ManagementKrController@line')->name('kr_management_line');
            Route::get('/op','ManagementKrController@op')->name('kr_management_op');
            Route::get('/part','ManagementKrController@part')->name('kr_management_part');
            Route::get('/model','ManagementKrController@model')->name('kr_management_model');
            Route::get('/size','ManagementKrController@size')->name('kr_management_size');
        });
        Route::prefix('defect')->group(function(){
            Route::get('/master','AdminKrController@defectmaster')->name('kr_management_defect_master');
            Route::get('/info','ManagementKrController@transaction_defect_info')->name('kr_management_defect_info');
        });
        Route::prefix('infotransaction')->group(function(){
            Route::get('/info','ManagementKrController@transaction_info')->name('kr_management_transaction_info');
            Route::get('/wip','ManagementKrController@wip_info')->name('kr_management_wip_info');
            Route::get('/production','ProductionKrController@production_info')->name('kr_management_production_info');
        });
    });
    Route::middleware(['sessionkrlogin','iskrqualitycontrol'])->prefix('qualitycontrol')->group(function(){
        Route::get('/home','ManagementKrController@index')->name('kr_qualitycontrol_home');
        Route::get('/workorder','ManagementKrController@workorder')->name('kr_qualitycontrol_workorder');
        Route::prefix('defect')->group(function(){
            Route::get('/master','AdminKrController@defectmaster')->name('kr_qualitycontrol_defect_master');
            Route::get('/info','ManagementKrController@transaction_defect_info')->name('kr_qualitycontrol_defect_info');
            Route::get('/defect','ManagementKrController@defect')->name('kr_qualitycontrol_defect');
        });
        Route::prefix('infotransaction')->group(function(){
            Route::get('/info','ManagementKrController@transaction_info')->name('kr_qualitycontrol_transaction_info');
            Route::get('/wip','ManagementKrController@wip_info')->name('kr_qualitycontrol_wip_info');
            Route::get('/production','ProductionKrController@production_info')->name('kr_qualitycontrol_production_info');
        });
    });
    Route::middleware(['sessionkrlogin','iskrproduction'])->prefix('production')->group(function(){
        Route::get('/home','ManagementKrController@index')->name('kr_production_home');
        Route::get('/workorder','ManagementKrController@workorder')->name('kr_production_workorder');
        Route::prefix('transaction')->group(function(){
            Route::get('/transaction','ManagementKrController@transaction')->name('kr_production_transaction');
        });
        Route::prefix('infotransaction')->group(function(){
            Route::get('/info','ManagementKrController@transaction_info')->name('kr_production_transaction_info');
            Route::get('/defect','ManagementKrController@transaction_defect_info')->name('kr_production_defect_info');
            Route::get('/wip','ManagementKrController@wip_info')->name('kr_production_wip_info');
            Route::get('/production','ProductionKrController@production_info')->name('kr_production_production_info');
        });
    });
    Route::middleware(['sessionkrlogin','iskradmin'])->prefix('admin')->group(function(){
        Route::get('/home','ManagementKrController@index')->name('kr_admin_home');
        Route::get('/workorder','ManagementKrController@workorder')->name('kr_admin_workorder');
        Route::prefix('basicinfo')->group(function(){
            Route::get('/bom','ManagementKrController@bom')->name('kr_admin_bom');
            Route::get('/leadtime','ManagementKrController@leadtime')->name('kr_admin_leadtime');
            Route::get('/routing','ManagementKrController@routing')->name('kr_admin_routing');
            Route::get('/line','ManagementKrController@line')->name('kr_admin_line');
            Route::get('/op','ManagementKrController@op')->name('kr_admin_op');
            Route::get('/part','ManagementKrController@part')->name('kr_admin_part');
            Route::get('/model','ManagementKrController@model')->name('kr_admin_model');
            Route::get('/size','ManagementKrController@size')->name('kr_admin_size');
        });
        Route::get('/transaction','ManagementKrController@transaction')->name('kr_admin_transaction');
        Route::prefix('defect')->group(function(){
            Route::get('/','ManagementKrController@defect')->name('kr_admin_defect');
            Route::get('/master','AdminKrController@defectmaster')->name('kr_admin_defect_master');
            Route::get('/info','ManagementKrController@transaction_defect_info')->name('kr_admin_defect_info');
        });
        Route::prefix('infotransaction')->group(function(){
            Route::get('/info','ManagementKrController@transaction_info')->name('kr_admin_transaction_info');
            Route::get('/wip','ManagementKrController@wip_info')->name('kr_admin_wip_info');
            Route::get('/production','ProductionKrController@production_info')->name('kr_admin_production_info');
        });
        Route::get('/users','AdminKrController@user')->name('kr_admin_users');
    });
});