<?php

use App\Modules\Views\Infra\Http\Controllers\ViewControllerImpl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ViewControllerImpl::class, 'home']);
Route::get('/dues', [ViewControllerImpl::class, 'dueList']);
Route::get('/due/{id}', [ViewControllerImpl::class, 'due']);
Route::get('/cadastro/due/novo', [ViewControllerImpl::class, 'newDue']);
