<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\ImportController::class, 'index'])->name('index');
Route::get('/books', [App\Http\Controllers\ImportController::class, 'getBooks'])->name('list');
Route::post('import-excel-csv-file', [App\Http\Controllers\ImportController::class, 'importExcelCSV'])->name('import');
Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

