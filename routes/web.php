<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VehicleDetailController;
use App\Http\Controllers\InventoryDetailController;

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

    // Brand
    Route::get('brands/import/', [BrandController::class, 'import'])->name('brands.import.view');
    Route::post('brands/import/', [BrandController::class, 'importHandler'])->name('brands.import.handler');
    Route::get('brands/export/', [BrandController::class, 'export'])->name('brands.export');
    Route::resource('/brands', BrandController::class);

    // Inventory
    Route::get('inventories/import/', [InventoryController::class, 'import'])->name('inventories.import.view');
    Route::post('inventories/import/', [InventoryController::class, 'importHandler'])->name('inventories.import.handler');
    Route::get('inventories/export/', [InventoryController::class, 'export'])->name('inventories.export');
    Route::resource('/inventories', InventoryController::class);

    // Inventory Detail
    Route::post('/inventory/details', [InventoryDetailController::class, 'store'])->name('inventory.details.store');
    Route::put('/inventory/{inventoryDetail}', [InventoryDetailController::class, 'update'])->name('inventory.details.update');

    // Vehicle
    Route::get('vehicles/import/', [VehicleController::class, 'import'])->name('vehicles.import.view');
    Route::post('vehicles/import/', [VehicleController::class, 'importHandler'])->name('vehicles.import.handler');
    Route::get('vehicles/export/', [VehicleController::class, 'export'])->name('vehicles.export');
    Route::resource('/vehicles', VehicleController::class);

    // Vehicle Detail
    Route::post('/vehicle/details', [VehicleDetailController::class, 'store'])->name('vehicle.details.store');
    Route::put('/vehicle/{vehicleDetail}', [VehicleDetailController::class, 'update'])->name('vehicle.details.update');

});

require __DIR__.'/auth.php';
