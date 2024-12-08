<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('getArchive', [ArchiveController::class, 'getArchive'])->name('getArchive');
Route::post('addArchive', [ArchiveController::class, 'addArchive'])->name('addArchive');
Route::post('store', [ArchiveController::class, 'store'])->name('store');