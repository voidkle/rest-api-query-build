<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BackpackController;
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

Route::get('/master', [BackpackController::class, 'master']);
Route::post('/master', [BackpackController::class, 'postusers']);
Route::put('/master/{id}', [BackpackController::class, 'putusers']);
Route::delete('/master/{id}', [BackpackController::class, 'deleteusers']);