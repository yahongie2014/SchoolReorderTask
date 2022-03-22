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
Route::post('login', [\App\Http\Controllers\HomeController::class, 'CreateOrLogin']);

Route::middleware(['auth:api','AdminAuth'])->group(function () {
    Route::apiResource('Student', 'App\Http\Controllers\StudentController');
    Route::apiResource('School', 'App\Http\Controllers\SchoolController');
});
