<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('customer/home');
});

Route::get('/LoginMitra', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/LoginMitra', [AuthController::class, 'login']);
Route::post('/LogoutMitra', [AuthController::class, 'logout'])->name('logout');

Route::get('/DashboardMitra', function () {
    return 'Selamat datang di Dashboard Mitra!';
})->middleware('auth');
