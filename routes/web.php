<?php

use App\Http\Controllers\VehicleReminderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\VehicleDetailController;
use App\Http\Controllers\VehicleReportController;
use App\Http\Controllers\InventoryDetailController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['role:admin'])->group(function () {
    // User
    Route::prefix('users')->group(function () {
        Route::get('/{user}/vehicles', [UserController::class, 'showUserVehicles'])->name('users.vehicles');
        Route::get('/{user}/inventories', [UserController::class, 'showUserInventories'])->name('users.inventories');
        Route::put('/{user}/change-password', [ProfileController::class, 'userUpdatePassword'])->name('users.password.update');
        Route::get('/import', [UserController::class, 'import'])->name('users.import.view');
        Route::post('/import', [UserController::class, 'importHandler'])->name('users.import.handler');
        Route::get('/export', [UserController::class, 'export'])->name('users.export');
    });
    Route::resource('users', UserController::class);

    // Offices
    Route::prefix('offices')->group(function () {
        Route::get('/import', [OfficeController::class, 'import'])->name('offices.import.view');
        Route::post('/import', [OfficeController::class, 'importHandler'])->name('offices.import.handler');
        Route::get('/export', [OfficeController::class, 'export'])->name('offices.export');
    });
    Route::resource('offices', OfficeController::class);

    // Brand
    Route::prefix('brands')->group(function () {
        Route::get('/import', [BrandController::class, 'import'])->name('brands.import.view');
        Route::post('/import', [BrandController::class, 'importHandler'])->name('brands.import.handler');
        Route::get('/export', [BrandController::class, 'export'])->name('brands.export');
    });
    Route::resource('brands', BrandController::class);

    // Inventory
    Route::prefix('inventories')->group(function () {
        Route::get('/import', [InventoryController::class, 'import'])->name('inventories.import.view');
        Route::post('/import', [InventoryController::class, 'importHandler'])->name('inventories.import.handler');
        Route::get('/export', [InventoryController::class, 'export'])->name('inventories.export');
    });
    Route::resource('inventories', InventoryController::class);

    // Inventory Detail
    Route::prefix('inventory')->group(function () {
        Route::post('/details', [InventoryDetailController::class, 'store'])->name('inventory.details.store');
        Route::put('/{inventoryDetail}', [InventoryDetailController::class, 'update'])->name('inventory.details.update');
    });

    // Vehicle
    Route::prefix('vehicles')->group(function () {
        Route::get('/import/excel', [VehicleController::class, 'importExcel'])->name('vehicles.import.excel');
        Route::post('/import/excel', [VehicleController::class, 'importHandlerExcel'])->name('vehicles.import.handler');
        Route::get('/export/excel', [VehicleController::class, 'exportExcel'])->name('vehicles.export.excel');
        Route::get('/export/pdf', [VehicleController::class, 'exportPdf'])->name('vehicles.export.pdf');

        // Vehicle Report
        Route::get('/report', [VehicleReportController::class, 'index'])->name('vehicles.report');

        // Vehicle Reminder
        Route::post('/reminder', [VehicleReminderController::class, 'usersReminder'])->name('vehicles.users.reminder');
        Route::post('/reminder/{vehicle}', [VehicleReminderController::class, 'userReminder'])->name('vehicles.user.reminder');
    });
    Route::resource('vehicles', VehicleController::class);

    // Vehicle Detail
    Route::prefix('vehicle')->group(function () {
        Route::post('/details', [VehicleDetailController::class, 'store'])->name('vehicle.details.store');
        Route::put('/{vehicleDetail}', [VehicleDetailController::class, 'update'])->name('vehicle.details.update');
    });

    // Recycle
    Route::prefix('recycle')->group(function () {
        // Inventories
        Route::get('/inventories', [InventoryController::class, 'showRecycled'])->name('inventories.recycle.show');
        Route::post('/inventories/{id}/restore', [InventoryController::class, 'restoreRecycled'])->name('inventories.recycle.restore');
        Route::delete('/inventories/{id}/delete', [InventoryController::class, 'deleteRecycled'])->name('inventories.recycle.delete');

        // Vehicles
        Route::get('/vehicles', [VehicleController::class, 'showRecycled'])->name('vehicles.recycle.show');
        Route::post('/vehicles/{id}/restore', [VehicleController::class, 'restoreRecycled'])->name('vehicles.recycle.restore');
        Route::delete('/vehicles/{id}/delete', [VehicleController::class, 'deleteRecycled'])->name('vehicles.recycle.delete');

        // Users
        Route::get('/users', [UserController::class, 'showRecycled'])->name('users.recycle.show');
        Route::post('/users/{id}/restore', [UserController::class, 'restoreRecycled'])->name('users.recycle.restore');
        Route::delete('/users/{id}/delete', [UserController::class, 'deleteRecycled'])->name('users.recycle.delete');
    });

});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // My Information
    Route::prefix('my')->group(function () {
        Route::get('/', [DashboardController::class, 'showMyInformation'])->name('my.information');
        Route::get('/inventories', [DashboardController::class, 'showMyInventories'])->name('my.inventories');
        Route::get('/inventories/{inventory}', [DashboardController::class, 'showMyInventoryDetail'])->name('my.inventory.detail');
        Route::get('/vehicles', [DashboardController::class, 'showMyVehicles'])->name('my.vehicles');
        Route::get('/vehicles/{vehicle}', [DashboardController::class, 'showMyVehicleDetail'])->name('my.vehicle.detail');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.edit.password');
        Route::put('/profile/change-password', [PasswordController::class, 'profileUpdatePassword'])->name('profile.password.update');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
