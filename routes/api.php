<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ADImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Controller;

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

Route::middleware('api')->post('/GetADImage', [ADImageController::class, 'GetADImage']);
Route::middleware('api')->post('/GetProduct', [ProductController::class, 'GetProduct']);

/* Login about Api */
Route::middleware('api')->post('/User/SignUp', [LoginController::class, 'SignUp']);