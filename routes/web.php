<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('auth.login');
}); 

Route::get('/register',[AuthController::class,'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class,'showLogin'])->name('show.login');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/transactions',[TransactionController::class,'index']);
Route::get('/transactions/add',[TransactionController::class,'showAddTransactionForm']);
Route::post('/transactions',[TransactionController::class,'store'])->name('transactions.store');