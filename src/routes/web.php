<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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
Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::get('/thanks', [ContactController::class, 'store']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);
Route::get('/admin', [ContactController::class, 'admin']);
Route::get('/export', [ContactController::class, 'export']);
Route::get('/admin/export', [ContactController::class, 'export']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::delete('/delete/{id}', [ContactController::class, 'destroy']);
Route::get('/search', [ContactController::class, 'search']);