<?php

use App\Http\Controllers\Admin\ArchivedFileController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\FolderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('folders', FolderController::class);
        Route::resource('files', FileController::class);
        Route::delete('/archive/{id}/files', [FileController::class, 'archive'])->name('files.archive');
        Route::post('/archived-files/{id}/restore', [ArchivedFileController::class, 'restore'])->name('archived-files.restore');
        Route::resource('archived', ArchivedFileController::class);

        Route::get('/live-search', [HomeController::class, 'liveSearch'])->name('live.search');
    });
});
