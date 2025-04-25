<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraAuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Public Routes (Customer)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('customer.home');
});

Route::get('/hidroponik', [ArtikelController::class, 'showHidroponikArticles']);
Route::get('/artikel/hidroponik', [ArtikelController::class, 'showArtikelHidroponik'])->name('artikel.hidroponik');

Route::get('/artikel/{slug}', function ($slug) {
    $artikel = App\Models\Artikel::where('slug', $slug)->firstOrFail();
    return view('customer.artikel-detail', compact('artikel'));
})->name('artikel.show');

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');

/*
|--------------------------------------------------------------------------
| Auth Routes (Mitra Only)
|--------------------------------------------------------------------------
*/

// Login & Logout Mitra
Route::get('/LoginMitra', [MitraAuthController::class, 'showLoginForm'])->name('mitra.login');
Route::post('/LoginMitra', [MitraAuthController::class, 'login']);
Route::post('/LogoutMitra', [MitraAuthController::class, 'logout'])->name('mitra.logout');

/*
|--------------------------------------------------------------------------
| Mitra Dashboard & Protected Routes
|--------------------------------------------------------------------------
*/

// Dashboard Route dengan middleware mitra.auth
Route::middleware('mitra.auth')->group(function () {
    // Dashboard
    Route::get('/DashboardMitra', function () {
        return view('mitra.DashboardMitra');
    })->name('mitra.dashboard');

    // Akun routes
    Route::get('/DataAkun', [MitraAuthController::class, 'showAkun'])->name('mitra.DataAkun');
    Route::get('/EditAkun', [MitraAuthController::class, 'editAkun'])->name('mitra.EditAkun');
    Route::put('/updateAkun', [MitraAuthController::class, 'updateAkun'])->name('mitra.updateAkun');

    // Artikel routes
    Route::prefix('DashboardMitra')->group(function () {
        Route::get('/Artikel', [ArtikelController::class, 'index'])->name('mitra.artikel.hidroponik');
        Route::get('/Artikel/create', [ArtikelController::class, 'create'])->name('mitra.artikel.create');
        Route::post('/Artikel', [ArtikelController::class, 'store'])->name('mitra.artikel.store');
        Route::get('/Artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('mitra.artikel.edit');
        Route::put('/Artikel/{artikel}', [ArtikelController::class, 'update'])->name('mitra.artikel.update');
        Route::delete('/Artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('mitra.artikel.destroy');
    });
});
