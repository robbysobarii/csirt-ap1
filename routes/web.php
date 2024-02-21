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
use App\Http\Controllers\LayananKamiController;
use App\Http\Controllers\NarahubungController;
use App\Http\Controllers\TentangKamiController;
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

// Route::get('/get-content/{type}', [ContentController::class, 'getContent']);
// Route::get('/', [ContentController::class, 'getContents'])->name('user.beranda');
// Route::get('/daftarBerita', [ContentController::class, 'listContent'])->name('daftarBerita');
// Route::get('/berita/{id}', [ContentController::class, 'showNews'])->name('berita');


// Route::get('/masuk', [AuthController::class, 'showLoginForm'])->name('masuk');
// Route::post('/masuk', [AuthController::class, 'login']);


// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('/masuk', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::controller(ContentController::class)->group(function(){
    Route::get('/', 'getContentsBeranda')->name('user.beranda');
    Route::get('/daftarBerita', 'listContent')->name('daftarBerita');
    Route::get('/berita/{id}', 'showNews')->name('berita');

});

Route::get('profil', function () {
    return view('user.profil');
})->name('profil');
Route::get('visiMisi', function () {
    return view('user.visiMisi');
})->name('visiMisi');
Route::get('struktur', function () {
    return view('user.struktur');
})->name('struktur');

Route::get('/profil', [TentangKamiController::class, 'profilBeranda'])->name('profil');
Route::get('/visiMisi', [TentangKamiController::class, 'visiMisiBeranda'])->name('visiMisi');
Route::get('/struktur', [TentangKamiController::class, 'strukturBeranda'])->name('struktur');


Route::get('/rfc', function () {
    return view('user.rfc');
})->name('user.rfc');


Route::get('/aduanSiber', function () {
    return view('user.aduanSiber');
})->name('aduanSiber');
Route::get('/layananVA', function () {
    return view('user.layananVA');
})->name('layananVA');
Route::get('/panduan', function () {
    return view('user.panduan');
})->name('panduan');

Route::get('/aduanSiber', [LayananKamiController::class, 'aduanBeranda'])->name('aduanSiber');
Route::get('/layananVA', [LayananKamiController::class, 'VABeranda'])->name('layananVA');
Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');

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

Route::get('/login', function () {
    return view('user.laporkanInsiden');
})->name('user.laporkanInsiden');

Route::prefix('/admin')->middleware(['auth', 'role:Admin'])->name('admin.')->group(function () {
    Route::get('/', [ContentController::class, 'index'])->name('contentManagement');
    Route::get('/galeryManagement', [GalleryController::class, 'index'])->name('galeryManagement');
    Route::get('/eventManagement', [EventController::class, 'getEvents'])->name('eventManagement');
    Route::get('/carouselManagement', [CarouselController::class, 'showCarousels'])->name('carousel');
    Route::get('/reportManagement',  [ReportsController::class, 'index'])->name('reportManagement');
    Route::get('/profilManagement',  [TentangKamiController::class, 'getProfil'])->name('profilManagement');
    Route::get('/visiMisiManagement',  [TentangKamiController::class, 'getVisiMisi'])->name('visiMisiManagement');
    Route::get('/strukturManagement',  [TentangKamiController::class, 'getStruktur'])->name('strukturManagement');
    Route::get('/aduanManagement',  [LayananKamiController::class, 'getAduan'])->name('aduanManagement');    Route::get('/aduanManagement',  [LayananKamiController::class, 'getAduan'])->name('aduanManagement');
    Route::get('/layananVAManagement',  [LayananKamiController::class, 'getVA'])->name('layananVAManagement');


    
});

Route::post('contents/storeOrUpdate', [ContentController::class, 'storeOrUpdate'])->name('contents.storeOrUpdate');
Route::delete('contents/delete/{id}', [ContentController::class, 'delete'])->name('contents.delete');
Route::get('/contents/{id}', [ContentController::class, 'show'])->name('contents.show');

Route::get('/galleries/{id}', [GalleryController::class, 'showGalery'])->name('galeri');
Route::post('/galleries/storeOrUpdate', [GalleryController::class, 'storeOrUpdate'])->name('galleries.storeOrUpdate');
Route::delete('/galleries/delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
Route::get('/galleries/show/{id}', [GalleryController::class, 'show'])->name('gallery.show');

Route::post('/events/storeOrUpdate', [EventController::class, 'storeOrUpdate'])->name('events.storeOrUpdate');
Route::delete('/events/delete/{id}', [EventController::class, 'delete'])->name('events.delete');
Route::get('/events/show/{id}', [EventController::class, 'show'])->name('events.show');

Route::post('/profils/storeOrUpdate', [EventController::class, 'storeOrUpdate'])->name('profils.storeOrUpdate');
Route::delete('/profils/delete/{id}', [EventController::class, 'delete'])->name('profils.delete');
Route::get('/profils/show/{id}', [EventController::class, 'showProfil'])->name('profils.show');

Route::post('/visis/storeOrUpdate', [EventController::class, 'storeOrUpdate'])->name('visis.storeOrUpdate');
Route::delete('/visis/delete/{id}', [EventController::class, 'delete'])->name('visis.delete');
Route::get('/visis/show/{id}', [EventController::class, 'showProfil'])->name('visis.show');

Route::post('/strukturs/storeOrUpdate', [EventController::class, 'storeOrUpdate'])->name('strukturs.storeOrUpdate');
Route::delete('/strukturs/delete/{id}', [EventController::class, 'delete'])->name('strukturs.delete');
Route::get('/strukturs/show/{id}', [EventController::class, 'showProfil'])->name('strukturs.show');

Route::post('/misis/storeOrUpdate', [EventController::class, 'storeOrUpdate'])->name('misis.storeOrUpdate');
Route::delete('/misis/delete/{id}', [EventController::class, 'delete'])->name('misis.delete');
Route::get('/misis/show/{id}', [EventController::class, 'showProfil'])->name('misis.show');


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

Route::prefix('pelapor')->middleware(['auth', 'role:Pelapor'])->name('pelapor.')->group(function () {
    Route::get('/',  [ReportsController::class, 'indexPelapor'])->name('reportPelapor');
});

Route::prefix('pimpinan')->middleware(['auth', 'role:Pimpinan'])->name('pimpinan.')->group(function () {
    Route::get('/', [ReportsController::class, 'showDashboard'])->name('dashboard');
    Route::get('/dataReport',  [ReportsController::class, 'indexPimpinan'])->name('dataReport');
});

Route::get('/superuser',  [UserController::class, 'index'])->middleware(['auth', 'role:Superuser'])->name('superuser');
Route::get('/narahubung',  [NarahubungController::class, 'index'])->middleware(['auth', 'role:Narahubung'])->name('narahubung');


// Route::get('/rfc/{filename}', [RfcPdfController::class, 'showRfcPdf'])->name('rfc.pdf');
Route::get('/panduan-teknis/{filename}', [PanduanController::class, 'detail'])->name('detailPanduan');