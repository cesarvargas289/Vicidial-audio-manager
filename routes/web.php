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

//Rutas de login
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('/', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('/', 'Auth\LoginController@login');

//Rutas de Errors
Route::get('401',['as'=>'401','uses'=>'ErrorHandlerController@errorCode401']);
Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']);
Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);


//Rutas de user, rol y campaigns
Route::resource('user', 'UserController');
Route::resource('rol', 'RoleController');
Route::resource('campaign', 'CampaignController');

//Rutas de audio
Route::get('audio', 'AudioController@indexGet');
Route::post('audio', ['as' => 'audio.post', 'uses' => 'AudioController@indexPost']);
Route::get('audio/download/{campana}/{mes}/{audio}',  'AudioController@download');
Route::get('audio/meses', 'AudioController@meses');
