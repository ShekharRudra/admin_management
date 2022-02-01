<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\AdminLoginController;

use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\LoginController;

use App\Http\Controllers\API\Admin\LearnController;
use App\Http\Controllers\API\Unique\HomeController;

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
@include('apiAdmin.php');
@include('apiUser.php');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware(['auth:api', 'UserTokenVerify'])->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware(['auth:api', 'AdminController'])->get('/admin', function (Request $request) {
//     Route::post('actionparametertype', [ParameterTypeController::class, 'updateOrCreateParameterType']);
// });

/* Admin api url */
Route::post('adminlogin', [AdminLoginController::class, 'login']);
Route::post('uploadvideo', [LearnController::class, 'uploadVideo']);

/*  User api url */ 
Route::post('register', [RegisterController::class, 'register']);
Route::post('signin', [LoginController::class, 'login']);
Route::post('chkemailverify', [RegisterController::class, 'checkEmailVerify']);
Route::post('checkforgotemail', [RegisterController::class, 'checkForgotEmail']);
Route::post('reset', [RegisterController::class, 'resetPassword']);

/* About Us, Contact Us & other Content api's */
Route::post('get_content_list', [HomeController::class, 'contentsList']);

Route::post('type_list', [HomeController::class, 'typeList']);
Route::post('side_list', [HomeController::class, 'sideList']);
Route::post('content_form', HomeController::class);