<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\BeritaController;
use App\Models\Berita;
use App\Models\Carousel;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\SambutanController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StrukturalController;

// ===============================
// PUBLIC ROUTES 
// ===============================
Route::get('/', function () {
    $berita = Berita::latest()->get();
    return view('dashboard.beranda', compact('berita'));
})->name('dashboard.beranda');

Route::get('/dashboard/sambutan', fn() => view('dashboard.sambutan'));
Route::get('/dashboard/tentang-kami', fn() => view('dashboard.tentang-kami'));
Route::get('/dashboard/berita-terkini', fn() => view('dashboard.berita-terkini'));

Route::get('/dashboard/berita-terkini', [BeritaController::class, 'index'])->name('dashboard.berita-terkini');

// Halaman berita publik
Route::get('/berita/home', function () {
    $berita = Berita::latest()->get();
    return view('berita.home', compact('berita'));
})->name('berita.home');

// ===============================
// ADMIN LOGIN
// ===============================

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// ===============================
// ADMIN ROUTES 
// ===============================

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    // CRUD Berita
    Route::resource('/berita', BeritaController::class)
        ->parameters(['berita' => 'berita']);

    Route::get('/admin/berita/{id}', [BeritaController::class, 'show'])->name('admin.berita.show');;

    Route::get('/admin/home', [BeritaController::class, 'beritaAdmin'])->name('admin.home');

    Route::prefix('admin')->group(function () {
        Route::get('frame/berita-terkini', [BeritaController::class, 'index'])->name('berita-terkini');
    });
    Route::get('/berita-terkini', function () {
        return view('berita-terkini');
    });

    // CRUD Struktural
    Route::resource('/struktural', StrukturalController::class)->except(['show']);
    Route::get('admin/struktural/{struktural}/edit', [StrukturalController::class, 'edit'])->name('admin.struktural.edit');


    // CRUD Carousel
    Route::resource('carousel', CarouselController::class);

    // CRUD Sambutan
    Route::resource('sambutan', SambutanController::class);
});
