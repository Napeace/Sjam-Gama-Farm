<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraAuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HidroponikController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TrainingVideoController;
use App\Http\Controllers\TrainingFormController;
use App\Http\Controllers\TrainingRegistrationController;

/*
|--------------------------------------------------------------------------
| Public Routes (Customer)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('customer.home');
});

Route::get('/category/{slug}', function ($slug) {
    // Untuk saat ini kita return view kosong
    return view('customer.category');
})->name('category');

Route::get('/hidroponik', [HidroponikController::class, 'index']);
Route::get('/artikel/hidroponik', [ArtikelController::class, 'showArtikelHidroponik'])->name('artikel.hidroponik');

Route::get('/artikel/{slug}', function ($slug) {
    $artikel = App\Models\Artikel::where('slug', $slug)->firstOrFail();
    return view('customer.artikel-detail', compact('artikel'));
})->name('artikel.show');

Route::get('/api/produk/{type}', [ProductController::class, 'getByType'])->name('api.produk.type');

Route::get('/produk', [ProductController::class, 'publicIndex'])->name('produk.index');
Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');

// Training Registration Routes (Public - untuk customer)
Route::get('/training/register/{trainingForm}', [TrainingRegistrationController::class, 'create'])->name('training.register');
Route::post('/training/register/{trainingForm}', [TrainingRegistrationController::class, 'store'])->name('training.register.store');
Route::get('/training/success', function () {
    return view('customer.training-success');
})->name('training.success');

// Training Video Routes (Public - untuk customer)
Route::get('/training-videos', [TrainingVideoController::class, 'publicIndex'])->name('training-videos.index');
Route::get('/training-videos/{trainingVideo}', [TrainingVideoController::class, 'publicShow'])->name('training-videos.show');

// Training Form Routes (Public - untuk customer)
Route::get('/training-forms', [TrainingFormController::class, 'publicIndex'])->name('training-forms.index');
Route::get('/training-forms/{trainingForm}', [TrainingFormController::class, 'publicShow'])->name('training-forms.show');
Route::post('/training-forms/{trainingForm}/submit', [TrainingFormController::class, 'submitAnswer'])->name('training-forms.submit');

// Notifications
Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/{id}/mark-read', [NotificationController::class, 'markAsRead']);
    Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/{id}/delete', [NotificationController::class, 'delete']);
    Route::delete('/delete-all', [NotificationController::class, 'deleteAll']);
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Mitra Only)
|--------------------------------------------------------------------------
*/

// Login & Logout Mitra
Route::get('/login-mitra', [MitraAuthController::class, 'showLoginForm'])->name('mitra.login');
Route::post('/login-mitra', [MitraAuthController::class, 'login']);
Route::post('/logout-mitra', [MitraAuthController::class, 'logout'])->name('mitra.logout');

/*
|--------------------------------------------------------------------------
| Mitra Dashboard & Protected Routes
|--------------------------------------------------------------------------
*/

// Dashboard Route dengan middleware mitra.auth
Route::middleware('mitra.auth')->group(function () {
    // Dashboard
    Route::get('/dashboard-mitra', function () {
        return view('mitra.dashboard-mitra');
    })->name('mitra.dashboard');

    // Akun routes
    Route::get('/data-akun', [MitraAuthController::class, 'showAkun'])->name('mitra.DataAkun');
    Route::get('/edit-akun', [MitraAuthController::class, 'editAkun'])->name('mitra.EditAkun');
    Route::put('/updateAkun', [MitraAuthController::class, 'updateAkun'])->name('mitra.updateAkun');

    Route::prefix('dashboard-mitra')->group(function () {
        // Artikel routes
        Route::get('/artikel', [ArtikelController::class, 'index'])->name('mitra.artikel.hidroponik');
        Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('mitra.artikel.create');
        Route::post('/artikel', [ArtikelController::class, 'store'])->name('mitra.artikel.store');
        Route::get('/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('mitra.artikel.edit');
        Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('mitra.artikel.update');
        Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('mitra.artikel.destroy');

        // Product routes
        Route::get('/produk', [ProductController::class, 'index'])->name('mitra.produk.index');
        Route::get('/produk/create', [ProductController::class, 'create'])->name('mitra.produk.create');
        Route::post('/produk', [ProductController::class, 'store'])->name('mitra.produk.store');
        Route::get('/produk/{product}/edit', [ProductController::class, 'edit'])->name('mitra.produk.edit');
        Route::put('/produk/{product}', [ProductController::class, 'update'])->name('mitra.produk.update');
        Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('mitra.produk.destroy');

        // Review routes
        Route::get('/reviews', [ReviewController::class, 'index'])->name('mitra.reviews.index');
        Route::get('/reviews/create', [ReviewController::class, 'create'])->name('mitra.reviews.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('mitra.reviews.store');
        Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('mitra.reviews.edit');
        Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('mitra.reviews.update');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('mitra.reviews.destroy');

        // Notification routes
        Route::post('/send', [NotificationController::class, 'send']);

        // Training Video routes (Mitra Management)
        Route::get('/training-videos', [TrainingVideoController::class, 'index'])->name('mitra.training-videos.index');
        Route::get('/training-videos/create', [TrainingVideoController::class, 'create'])->name('mitra.training-videos.create');
        Route::post('/training-videos', [TrainingVideoController::class, 'store'])->name('mitra.training-videos.store');
        Route::get('/training-videos/{trainingVideo}', [TrainingVideoController::class, 'show'])->name('mitra.training-videos.show');
        Route::get('/training-videos/{trainingVideo}/edit', [TrainingVideoController::class, 'edit'])->name('mitra.training-videos.edit');
        Route::put('/training-videos/{trainingVideo}', [TrainingVideoController::class, 'update'])->name('mitra.training-videos.update');
        Route::delete('/training-videos/{trainingVideo}', [TrainingVideoController::class, 'destroy'])->name('mitra.training-videos.destroy');
        Route::patch('/training-videos/{trainingVideo}/toggle-status', [TrainingVideoController::class, 'toggleStatus'])->name('mitra.training-videos.toggle-status');

        // Form Pelatihan routes (Mitra Management)
        Route::get('/training-forms', [TrainingFormController::class, 'index'])->name('mitra.training-forms.index');
        Route::get('/training-forms/create', [TrainingFormController::class, 'create'])->name('mitra.training-forms.create');
        Route::post('/training-forms', [TrainingFormController::class, 'store'])->name('mitra.training-forms.store');
        Route::get('/training-forms/{trainingForm}', [TrainingFormController::class, 'show'])->name('mitra.training-forms.show');
        Route::get('/training-forms/{trainingForm}/edit', [TrainingFormController::class, 'edit'])->name('mitra.training-forms.edit');
        Route::put('/training-forms/{trainingForm}', [TrainingFormController::class, 'update'])->name('mitra.training-forms.update');
        Route::delete('/training-forms/{trainingForm}', [TrainingFormController::class, 'destroy'])->name('mitra.training-forms.destroy');
        Route::patch('/training-forms/{trainingForm}/toggle', [TrainingFormController::class, 'toggle'])->name('mitra.training-forms.toggle');
        Route::get('/training-forms/{trainingForm}/answers', [TrainingFormController::class, 'viewAnswers'])->name('mitra.training-forms.answers');

        // Training Registration Management routes (Mitra)
        Route::get('/training-registrations', [TrainingRegistrationController::class, 'index'])->name('mitra.training-registrations.index');
        Route::get('/training-registrations/{trainingRegistration}', [TrainingRegistrationController::class, 'show'])->name('mitra.training-registrations.show');
        Route::patch('/training-registrations/{trainingRegistration}/status', [TrainingRegistrationController::class, 'updateStatus'])
            ->name('mitra.training-registrations.update-status');
    });
});
