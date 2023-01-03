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
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::post('custom-login', [AuthController::class, 'login'])->name('signin'); 
Route::get('registration', [AuthController::class, 'register'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'registerUser'])->name('register'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('list-order',[OrderController::class, 'index'] )->name('list-order');
Route::get('form-order',[OrderController::class, 'formOrder'] )->name('form-order');
Route::post('save-order',[OrderController::class, 'create'])->name('save');
Route::get('order/{id}',[OrderController::class, 'show'] )->name('order');
Route::get('order/update/{id}/{status}',[OrderController::class, 'updateStatus'] );
Route::delete('delete/{id}',[OrderController::class, 'destroy'] )->name('destroy');
Route::put('order/{id}',[OrderController::class, 'update'] )->name('update');

Route::get('list-inventory',[InventoryController::class,'index'])->name('list-inventory');
Route::get('form-inventory',[InventoryController::class,'formInventory'])->name('form-inventory');
Route::post('save-product',[InventoryController::class,'create'])->name('save-product');
Route::get('product/{id}',[InventoryController::class, 'show'] )->name('product');
Route::put('update/product/{id}',[InventoryController::class, 'update'] )->name('update');
Route::delete('delete/product/{id}',[InventoryController::class, 'destroy'] )->name('destroy');