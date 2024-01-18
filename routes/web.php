<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RfcPdfController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\FeatureController;
use App\Models\Reports;
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

Route::get('/masuk', [AuthController::class, 'showLoginForm'])->name('masuk');
Route::post('/masuk', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ContentController::class, 'getContents'])->name('user.beranda');

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

Route::get('/detailPanduanList', function () {
    return view('user.detailPanduan');
})->name('detailPanduanList');

Route::get('/event', function () {
    return view('user.event');
})->name('user.event');

Route::post('/show-countdown-popup', [AuthController::class, 'showCountdownPopup']);

Route::get('/event', [EventController::class, 'eventBeranda'])->name('user.event');

Route::get('/hubungiKami', function () {
    return view('user.hubungiKami');
})->name('user.hubungiKami');

Route::get('/login', function () {
    return view('user.laporkanInsiden');
})->name('login');

Route::prefix('/admin')->middleware(['auth', 'role:Admin,Superuser'])->name('admin.')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('contentManagement');


    Route::get('/galeryManagement', [GalleryController::class, 'index'])->name('galeryManagement');

    Route::get('/eventManagement', [EventController::class, 'getEvents'])->name('eventManagement');

    Route::get('/carouselManagement', [CarouselController::class, 'showCarousels'])->name('carousel');

    Route::get('/reportManagement',  [ReportsController::class, 'index'])->name('reportManagement');
});

Route::post('/admin/galleries/storeOrUpdate', [GalleryController::class, 'storeOrUpdate'])->name('galleries.storeOrUpdate');
Route::delete('/admin/galleries/delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
Route::get('/galleries/show/{id}', [GalleryController::class, 'show'])->name('gallery.show');

Route::post('contents/storeOrUpdate', [ContentController::class, 'storeOrUpdate'])->name('contents.storeOrUpdate');
Route::delete('contents/delete/{id}', [ContentController::class, 'delete'])->name('contents.delete');
Route::get('/contents/{id}', [ContentController::class, 'show'])->name('contents.show');


Route::post('/events/storeOrUpdate', [EventController::class, 'storeOrUpdate'])->name('events.storeOrUpdate');
Route::delete('/events/delete/{id}', [EventController::class, 'delete'])->name('events.delete');
Route::get('/events/show/{id}', [EventController::class, 'show'])->name('events.show');

Route::post('/admin/carousel/storeOrUpdate', [CarouselController::class, 'storeOrUpdate'])->name('carousel.storeOrUpdate');
Route::delete('/admin/carousel/delete/{id}', [CarouselController::class, 'delete'])->name('carousel.delete');
Route::get('/carousel/show/{id}', [CarouselController::class, 'show'])->name('carousel.show');

Route::post('/user', [UserController::class, 'storeOrUpdate'])->name('users.storeOrUpdate');
Route::delete('/user/{id}', [UserController::class, 'deleteUsermanagement'])->name('user.delete');
Route::delete('/user/{id}', [UserController::class, 'deleteUsermanagement'])->name('users.delete');
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');

Route::post('/pelapor/storeOrUpdate', [ReportsController::class, 'storeOrUpdate'])->name('pelapor.storeOrUpdate');
Route::delete('/pelapor/{id}', [ReportsController::class, 'delete'])->name('pelapor.delete');
Route::get('/pelapor/show/{id}', [ReportsController::class, 'show'])->name('pelapor.show');

Route::post('/report', [ReportsController::class, 'store'])->name('report.store');
Route::delete('/report/{id}', [ReportsController::class, 'delete'])->name('report.delete');
Route::put('/report/update', [ReportsController::class, 'update'])->name('report.update');

Route::put('/updateProfile/{id}', [UserController::class, 'update'])->name('updateProfil');
Route::get('/editProfile/{id}', [UserController::class, 'editProfile'])->name('editProfil');

Route::middleware(['api','api.auth'])->prefix('pelapor')->name('pelapor.')->group(function () {
    Route::get('/',  [ReportsController::class, 'indexPelapor'])->name('reportPelapor');
});

Route::middleware(['api','api.auth'])->prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('/', [ReportsController::class, 'showDashboard'])->name('dashboard');
    Route::get('/dataReport',  [ReportsController::class, 'indexPimpinan'])->name('dataReport');
});

Route::get('/superuser',  [UserController::class, 'index'])->middleware(['api','api.auth'])->name('superuser');

Route::get('/rfc/{filename}', [RfcPdfController::class, 'showRfcPdf'])->name('rfc.pdf');
Route::get('/detail-panduan/{filename}/{name}', [PanduanController::class, 'showDetail'])->name('detailPanduan');

Route::get('/features', [FeatureController::class, 'index'])->name('admin.activate');
Route::get('/features/{id}/activate', [FeatureController::class, 'activate'])->name('features.activate');
Route::get('/features/{id}/deactivate', [FeatureController::class, 'deactivate'])->name('features.deactivate');
