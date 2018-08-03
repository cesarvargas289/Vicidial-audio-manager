<?php
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});


Route::resource('user', 'UserController');

Route::get('401',['as'=>'401','uses'=>'ErrorHandlerController@errorCode401']);
Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']);
Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);

Route::resource('rol', 'RoleController');
Route::resource('campaign', 'CampaignController');

Route::get('audio', 'AudioController@indexGet');
//Route::post('audio', 'AudioController@indexPost');
Route::post('audio', ['as' => 'audio.post', 'uses' => 'AudioController@indexPost']);
Route::get('audio/download/{campana}/{mes}/{audio}',  'AudioController@download');

Route::get('audio/meses', 'AudioController@meses');
