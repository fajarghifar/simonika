<?php

use App\Http\Controllers\OfficeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Offices
    Route::get('offices/import/', [OfficeController::class, 'import'])->name('offices.import.view');
    Route::post('offices/import/', [OfficeController::class, 'importHandler'])->name('offices.import.handler');
    Route::get('offices/export/', [OfficeController::class, 'export'])->name('offices.export');
    Route::resource('/offices', OfficeController::class);

});

require __DIR__.'/auth.php';
