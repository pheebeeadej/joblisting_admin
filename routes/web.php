<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\welcome_controller;
use App\Http\Controllers\password_reset_controller;
use App\Http\Controllers\password_change;
use App\Http\Controllers\listjob_controller;
use App\Http\Controllers\addjob_controller;
use App\Http\Controllers\editjob_controller;
use App\Http\Controllers\profile_controller;

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

// profile 
Route::get('/profile', [profile_controller::class,'index']);
Route::post('/change_pass', [profile_controller::class,'change_pass']);
// editjob_controller
Route::get('/editjob', [editjob_controller::class,'index']);
Route::post('/editjob', [editjob_controller::class,'editjob']);
// addjob_controller
Route::get('/addjob', [addjob_controller::class,'index']);
Route::post('/addjob', [addjob_controller::class,'addjob']);
// view_score
Route::get('/listjob',  [listjob_controller::class,'index']);
// create nw passowrd form for forgot password
Route::get('/password_change/{token}', [password_change::class,'index']);
Route::post('/password_change', [password_change::class,'password_change']);
Route::get('/password_change', [password_change::class,'index2']);
// forgot password form
Route::get('/forgot_pass', [password_reset_controller::class,'forgot_pass_index']);
Route::post('/forgot_pass', [password_reset_controller::class,'forgot_pass']);
//welcome
Route::get('/',  [welcome_controller::class,'index']);
Route::get('/login',  [welcome_controller::class,'index']);
Route::post('/login', [welcome_controller::class,'login']);

Route::get('/logout', [welcome_controller::class,'logout']);
// Route::get('/', function () {
//     return view('pages.login');
// });


Route::get('/admin', function () {
    return view('errors.404');
});
Route::post('/admin', function () {
    return view('errors.404');
});
Route::group(['prefix' => 'not_found_pages_here'], function () {
    Voyager::routes();
});