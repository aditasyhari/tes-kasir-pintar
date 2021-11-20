<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;

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

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/barang', [BarangController::class, 'index']);


Auth::routes();

Route::middleware('auth')->group(function() {
    
    Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::put('/barang/update', [BarangController::class, 'update']);
    
    Route::middleware('admin')->group(function() {
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
    });

});



