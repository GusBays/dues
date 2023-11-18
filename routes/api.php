<?php

use App\Modules\Due\Infra\Http\Controllers\DueControllerImpl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/dues', [DueControllerImpl::class, 'store']);
Route::get('/dues', [DueControllerImpl::class, 'index']);
Route::get('/dues/{id}', [DueControllerImpl::class, 'show']);
Route::put('/dues/{id}', [DueControllerImpl::class, 'update']);
Route::delete('/dues/{id}', [DueControllerImpl::class, 'destroy']);
