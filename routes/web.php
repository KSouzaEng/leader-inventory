<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::post('custom-login', [AuthController::class, 'login'])->name('signin'); 
Route::get('registration', [AuthController::class, 'register'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'registerUser'])->name('register'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('form-order',[OrderController::class, 'index'] )->name('form-order');
Route::get('list-order',[OrderController::class, 'show'] )->name('list-order');
Route::post('save-order',[OrderController::class, 'create'])->name('save');

Route::get('list-inventory',[InventoryController::class,'index'])->name('list-inventory');