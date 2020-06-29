<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/workorders','ApiController@workorders');
Route::post('/addworkorder','ApiController@addworkorder');
Route::post('/editworkorder','ApiController@editworkorder');

Route::get('/getCountOfBOM','ApiController@getCountOfBOM');
Route::get('/getBOM/{bom_parent}','ApiController@getBOM');


Route::get('/lines','ApiController@lines');
Route::post('/addline','ApiController@addline');
Route::post('/editline','ApiController@editline');

Route::get('/leadtimes','ApiController@leadtimes');
Route::post('/addleadtime','ApiController@addleadtime');
Route::post('/editleadtime','ApiController@editleadtime');

Route::get('/routings','ApiController@routings');
Route::post('/addrouting','ApiController@addrouting');
Route::post('/editrouting','ApiController@editrouting');

Route::get('/routingpartno','ApiController@routingpartno');
Route::get('/boms','ApiController@boms');
Route::post('/addbom','ApiController@addbom');
Route::post('/editbom','ApiController@editbom');

Route::get('/ops','ApiController@ops');
Route::post('/addop','ApiController@addop');
Route::post('/editop','ApiController@editop');

Route::get('/parts','ApiController@parts');
Route::post('/addpart','ApiController@addpart');
Route::post('/editpart','ApiController@editpart');

Route::get('/models','ApiController@models');
Route::post('/addmodel','ApiController@addmodel');
Route::post('/editmodel','ApiController@editmodel');

Route::get('/sizes','ApiController@sizes');
Route::post('/addsize','ApiController@addsize');
Route::post('/editsize','ApiController@editsize');

Route::get('/defectinfos','ApiController@defectinfos');
Route::post('/adddefectinfo','ApiController@adddefectinfo');
Route::post('/editdefectinfo','ApiController@editdefectinfo');

Route::post('/wostat','ApiController@wostat');
Route::post('/processchild','ApiController@processchild');
Route::post('/countWip','ApiController@countWip');
Route::post('/getprocesschange','ApiController@getprocesschange');
Route::post('/getbaseqtyparent','ApiController@getbaseqtyparent');
Route::get('/defectinfo','ApiController@defectinfo');
Route::post('/getdefectinfo','ApiController@getdefectinfo');
Route::get('/datawo/{assystart}/{assyend}/{part_no}','ApiController@datawo');
Route::post('/processdefectchild','ApiController@processdefectchild');
Route::post('/transactions','ApiController@transactions');
Route::post('/defects','ApiController@defects');
Route::post('/wipinfo','ApiController@wipinfo');
Route::post('/wipinfo2','ApiController@wipinfo2');

Route::get('/getDataFullQty','ApiController@getDataFullQty');
Route::post('/getDataQty','ApiController@getDataQty');
Route::get('/getDataByPartNo','ApiController@getDataByPartNo');
Route::get('/top5defect','ApiController@top5defect');
Route::get('/user/{id}','ApiController@getDataUser');

Route::prefix('/admin')->group(function(){
    Route::get('/users','AdminApiController@users');
    Route::post('/adduser','AdminApiController@adduser');
    Route::post('/edituser','AdminApiController@edituser');
    Route::get('/deleteuser/{id}','AdminApiController@deleteuser');
});
Route::prefix('option')->group(function(){
    Route::get('/get','AdminApiController@option');
    Route::get('/setcollapse/{data}','AdminApiController@setcollapse');
});