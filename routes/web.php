<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowerController;
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

Route::get('/', function () {
    return view('user_panel');
});

Route::get('/admin', function () {
    return view('index');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/getBorrowers', [BorrowerController::class,'getBorrowers'])->name('get_borrowers');
Route::post('/add_borrower', [BorrowerController::class,'add_borrower'])->name('add_borrower');
Route::post('/update_borrower', [BorrowerController::class,'update_borrower'])->name('update_borrower');
Route::post('/delete_borrower', [BorrowerController::class,'delete_borrower'])->name('delete_borrower');