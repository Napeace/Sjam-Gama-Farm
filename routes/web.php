<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraAuthController;
use App\Http\Controllers\ArtikelController;


/*
|--------------------------------------------------------------------------
| Public Routes (Customer)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('customer.home');
});

Route::get('/hidroponik', function () {
    return view('customer.hidroponik');
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

// Dashboard
Route::get('/DashboardMitra', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return view('mitra.DashboardMitra');
})->name('mitra.dashboard');

// Akun routes
Route::get('/DataAkun', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\MitraAuthController::class)->showAkun();
})->name('mitra.DataAkun');

Route::get('/EditAkun', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\MitraAuthController::class)->editAkun();
})->name('mitra.EditAkun');

Route::put('/updateAkun', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\MitraAuthController::class)->updateAkun(request());
})->name('mitra.updateAkun');

// Artikel routes
Route::get('/DashboardMitra/Artikel', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\ArtikelController::class)->index();
})->name('mitra.artikel.hidroponik');

Route::get('/DashboardMitra/Artikel/create', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\ArtikelController::class)->create();
})->name('mitra.artikel.create');

Route::post('/DashboardMitra/Artikel', function () {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\ArtikelController::class)->store(request());
})->name('mitra.artikel.store');

Route::get('/DashboardMitra/Artikel/{artikel}/edit', function (App\Models\Artikel $artikel) {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\ArtikelController::class)->edit($artikel);
})->name('mitra.artikel.edit');

Route::put('/DashboardMitra/Artikel/{artikel}', function (App\Models\Artikel $artikel) {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\ArtikelController::class)->update(request(), $artikel);
})->name('mitra.artikel.update');

Route::delete('/DashboardMitra/Artikel/{artikel}', function (App\Models\Artikel $artikel) {
    if (!Auth::check()) {
        return redirect('/LoginMitra');
    }
    return app(\App\Http\Controllers\ArtikelController::class)->destroy($artikel);
})->name('mitra.artikel.destroy');
