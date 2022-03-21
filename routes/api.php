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

Route::post('login', 'AuthController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('test', function(){
        return 'test';
    });
});

Route::get('cek', function(){
    return 'ok';
});

Route::get('laporan/pencarian', 'LaporanController@pencarian');
Route::resource('laporan', 'LaporanController');
Route::get('user/get_user','CheckinController@get_user');
Route::post('user/checkin','CheckinController@check_in');
Route::post('user/checklist_presensi','CheckinController@checklist_presensi');
Route::post('user/checklist_jammasuk','CheckinController@checklist_jammasuk');
Route::post('user/checkout','CheckinController@check_out');

Route::post('user/cuti_submit','AbsenController@cuti_submit');
Route::post('user/dispensasi_submit','AbsenController@dispensasi_submit');
Route::post('user/ijin_submit','AbsenController@ijin_submit');
Route::post('user/sakit_submit','AbsenController@sakit_submit');

Route::post('user/lembur_submit','AbsenController@lembur_submit');
Route::post('user/lemburkhusus_submit','AbsenController@lemburkhusus_submit');


