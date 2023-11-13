<?php

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
    return view('user.beranda');
})->name('user.beranda');

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('administrator.contentManagement');
    })->name('contentManagement');
    Route::get('galeryManagement', function () {
        return view('administrator.galeryManagement');
    })->name('galeryManagement');
    Route::get('eventManagement', function () {
        return view('administrator.event');
    })->name('eventManagement');

    Route::get('carouselManagement', function () {
        return view('administrator.carousel');
    })->name('carousel');
    Route::get('activateManagement', function () {
        return view('administrator.activate');
    })->name('activate');
    
    Route::get('userManagement', function () {
        return view('administrator.userManagemen');
    })->name('userManagement');
    
    Route::get('reportManagement', function () {
        return view('administrator.report');
    })->name('reportManagement');
});

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