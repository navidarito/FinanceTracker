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



Route::get('/home', function () {
    return view('layouts.app');
}); 

Route::get('/', function () {
    return view('auth.login');
}); 


Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/register','showRegister')->name('show.register');
    Route::get('/login','showLogin')->name('show.login');
    Route::post('/register','register')->name('register');
    Route::post('/login','login')->name('login');

});

Route::middleware('auth')->controller(TransactionController::class)->group(function(){
    Route::get('/transactions','index');
    Route::get('/transactions/add','showAddTransactionForm');
    Route::post('/transactions','store')->name('transaction.store');
    Route::get('/transactions/{id}','edit')->name('transaction.edit');
    Route::put('/transactions/{id}','update')->name('transaction.update');
    Route::delete('/transactions/{id}', 'destroy')->name('transaction.destroy');

});




/*     
    Route::get('/register',[AuthController::class,'showRegister'])->name('show.register');
    Route::get('/login',[AuthController::class,'showLogin'])->name('show.login');
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout'); 

    Route::get('/transactions',[TransactionController::class,'index']);
    Route::get('/transactions/add',[TransactionController::class,'showAddTransactionForm']);
    Route::post('/transactions',[TransactionController::class,'store'])->name('transaction.store');
    Route::get('/transactions/{id}',[TransactionController::class,'edit'])->name('transaction.edit');
    Route::put('/transactions/{id}',[TransactionController::class,'update'])->name('transaction.update');
    Route::delete('/transactions/{id}', [TransactionController::class,'destroy'])->name('transaction.destroy');
    
*/