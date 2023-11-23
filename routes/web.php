<?php

use App\Http\Controllers\RfcPdfController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ContentController::class, 'getContents'] )->name('user.beranda');

// Route::get('/get-content/{type}', [ContentController::class, 'getContent']);

Route::get('/daftarBerita', [ContentController::class, 'listContent'])->name('daftarBerita');

Route::get('/berita/{id}', [ContentController::class, 'showNews'])->name('berita');

Route::get('/galeri/{id}', [GalleryController::class, 'showGalery'])->name('galeri');

Route::prefix('tentangKami')->name('tentangKami.')->group(function () {
    Route::get('/tentangKami/profil', function () {
        return view('user.profil');
    })->name('profil');
    Route::get('/tentangKami/visiMisi', function () {
        return view('user.visiMisi');
    })->name('visiMisi');
    Route::get('/tentangKami/struktur', function () {
        return view('user.struktur');
    })->name('struktur');
});

Route::get('/rfc', function () {
    return view('user.rfc');
})->name('user.rfc');

Route::get('/layanan', function () {
    return view('user.layanan');
})->name('user.layanan');

Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/layanan/aduanSiber', function () {
        return view('user.aduanSiber');
    })->name('aduanSiber');
    Route::get('/layanan/layananVA', function () {
        return view('user.layananVA');
    })->name('layananVA');
    Route::get('/layanan/panduan', function () {
        return view('user.panduan');
    })->name('panduan');
});

Route::get('/detailPanduan', function () {
    return view('user.detailPanduan');
})->name('detailPanduan');

Route::get('/event', function () {
    return view('user.event');
})->name('user.event');

Route::get('/event', [EventController::class, 'eventBeranda'])->name('user.event');

Route::get('/hubungiKami', function () {
    return view('user.hubungiKami');
})->name('user.hubungiKami');

Route::get('/laporkanInsiden', function () {
    return view('user.laporkanInsiden');
})->name('user.laporkanInsiden');

Route::prefix('/admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('contentManagement');
    
    
    Route::get('/galeryManagement', [GalleryController::class, 'index'])->name('galeryManagement');
    
    Route::get('/eventManagement', [EventController::class, 'getEvents'])->name('eventManagement');

    Route::get('/carouselManagement', [CarouselController::class, 'showCarousels'])->name('carousel');
    // Route::get('activateManagement', function () {
    //     return view('administrator.activate');
    // })->name('activate');

    Route::get('/userManagement',  [UserController::class, 'index'])->name('userManagement');
    
    Route::get('/reportManagement',  [ReportsController::class, 'index'])->name('reportManagement');

});

Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
Route::delete('/galleries/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
Route::post('contents/store', [ContentController::class, 'store'])->name('contents.store');
Route::delete('contents/delete/{id}', [ContentController::class, 'delete'])->name('contents.delete');
Route::post('/event', [EventController::class, 'store'])->name('event.store');
Route::delete('/event/{id}', [EventController::class, 'delete'])->name('event.delete');
Route::post('/carousel', [CarouselController::class, 'store'])->name('carousel.store');
Route::delete('/carousel/{id}', [CarouselController::class, 'delete'])->name('carousel.delete');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::post('/report', [ReportsController::class, 'store'])->name('report.store');
Route::delete('/report/{id}', [ReportsController::class, 'delete'])->name('report.delete');


Route::prefix('pelapor')->name('pelapor.')->group(function () {
    Route::get('/', function () {
        return view('pelapor.pelapor');
    })->name('reportPelapor');
});

Route::prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('/', function () {
        return view('pimpinan.dashboard');
    })->name('dashboard');
    Route::get('/dataReport', function () {
        return view('pimpinan.dataReport');
    })->name('dataReport');
});

Route::get('/superuser', function () {
    return view('superuser.superuser');
})->name('superuser');

Route::get('/rfc/{filename}', [RfcPdfController::class, 'showRfcPdf'])->name('rfc.pdf');
Route::get('/detail-panduan/{filename}/{name}', [PanduanController::class, 'showDetail'])->name('detailPanduan');
