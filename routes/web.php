<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LatesController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\StudentsController;
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

// Route::get('/', function () {
//     return view('login');
// })->name('login');

Route::middleware('IsGuest')->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

// Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
// Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', function () {
        return view('home');
    })->name('home.page');
});

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('errors.permission');

Route::middleware(['IsLogin', 'IsAdmin'])->group(function() {
    // Route::get('/home', function () {
    //     return view('home');
    // })->name('home.page');

    Route::prefix('/user')->name('user.')->group(function() {
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/', [UserController::class, 'index'])->name('home');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });

    // Route::prefix('/lates')->name('lates.')->group(function() {
    //     Route::get('/create', [LatesController::class, 'create'])->name('create');
    // });

    Route::prefix('/rombel')->name('rombel.')->group(function() {
        Route::get('/create', [RombelController::class, 'create'])->name('create');
        Route::post('/store', [RombelController::class, 'store'])->name('store');
        Route::get('/', [RombelController::class, 'index'])->name('home');
        Route::get('/search', [RombelController::class, 'search'])->name('search');
        Route::delete('/{id}', [RombelController::class, 'destroy'])->name('delete');
        Route::get('/{id}', [RombelController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RombelController::class, 'update'])->name('update');
    });

    Route::prefix('/rayon')->name('rayon.')->group(function() {
        Route::get('/create', [RayonController::class, 'create'])->name('create');
        Route::post('/store', [RayonController::class, 'store'])->name('store');
        Route::get('/', [RayonController::class, 'index'])->name('home');
        Route::get('/{id}', [RayonController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RayonController::class, 'update'])->name('update');
        Route::delete('/{id}', [RayonController::class, 'destroy'])->name('delete');
    });    

    Route::prefix('/students')->name('students.')->group(function() {
        Route::get('/create', [StudentsController::class, 'create'])->name('create');
        Route::post('/store', [StudentsController::class, 'store'])->name('store');
        Route::get('/', [StudentsController::class, 'index'])->name('home');
        Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('delete');
        Route::get('/{id}', [StudentsController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StudentsController::class, 'update'])->name('update');
    });

    Route::prefix('/lates')->name('lates.')->group(function () {
        Route::get('/create', [LatesController::class, 'create'])->name('create');
        Route::post('/store', [LatesController::class, 'store'])->name('store');
        Route::get('/', [LatesController::class, 'index'])->name('home');
        Route::delete('/{id}', [LatesController::class, 'destroy'])->name('delete');
        Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
        Route::get('/lihat/{student_id}', [LatesController::class, 'show'])->name('lihat');
        Route::get('/{id}', [LatesController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LatesController::class, 'update'])->name('update');
        Route::get('/print/{id}', [LatesController::class, 'print'])->name('print');
        Route::get('/download/{id}', [LatesController::class, 'downloadPDF'])->name('download-pdf');
        Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
        Route::get('/data', [LatesController::class, 'data'])->name('data');
    });

});

Route::middleware(['IsLogin', 'IsPS'])->group(function () {
    Route::prefix('/ps')->name('ps.')->group(function() {
        // Route::get('/home', function () {
        //     return view('welcome');
        // })->name('home');
        // Route::prefix('/dashboard')->name('dashboard.')->group(function() {
        //     Route::get('/', [RayonController::class, 'dashboard'])->name('home');
        // });

        Route::prefix('/students')->name('students.')->group(function() {
            Route::get('/', [StudentsController::class, 'student'])->name('home');
        });

        Route::prefix('/lates')->name('lates.')->group(function () {
            Route::get('/', [LatesController::class, 'keterlambatan'])->name('home');
            Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
            Route::get('/lihat/{student_id}', [LatesController::class, 'show'])->name('lihat');
            Route::get('/print/{id}', [LatesController::class, 'printps'])->name('print');
            Route::get('/download/{id}', [LatesController::class, 'downloadPDFps'])->name('download-pdf');
            Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
        });

    });
});