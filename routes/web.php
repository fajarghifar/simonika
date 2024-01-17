<?php

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
use App\Http\Controllers\VehicleReminderController;
use App\Http\Controllers\VehicleExtensionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['role:admin'])->group(function () {
    // User
    Route::prefix('users')->group(function () {
        Route::get('/import', [UserController::class, 'import'])->name('users.import.view');
        Route::post('/import', [UserController::class, 'importHandler'])->name('users.import.handler');
        Route::get('/export', [UserController::class, 'export'])->name('users.export');

        Route::get('/{user}/vehicles', [UserController::class, 'showUserVehicles'])->name('users.vehicles');
        Route::get('/{user}/inventories', [UserController::class, 'showUserInventories'])->name('users.inventories');
        Route::put('/{user}/change-password', [ProfileController::class, 'userUpdatePassword'])->name('users.password.update');
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

        // Borrowed Inventory (Inventory Details)
        Route::get('/{inventory}/history', [InventoryDetailController::class, 'index'])->name('inventories.borrowing.history');
        Route::get('/{inventory}/borrow', [InventoryDetailController::class, 'show'])->name('inventories.borrow');
        Route::post('/{inventory}/borrow', [InventoryDetailController::class, 'store'])->name('inventories.borrow.store');
        Route::put('/{inventoryDetail}/return', [InventoryDetailController::class, 'update'])->name('inventories.return');
    });
    Route::resource('inventories', InventoryController::class);

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

        // Vehicle Extensions Report
        Route::get('/extensions', [VehicleExtensionController::class, 'adminIndex'])->name('vehicles.extensions.index');
        Route::get('/extensions/{vehicleExtension}', [VehicleExtensionController::class, 'adminShow'])->name('vehicles.extensions.show');
        Route::put('/extensions/{vehicleExtension}', [VehicleExtensionController::class, 'adminUpdate'])->name('vehicles.extensions.update');
        Route::delete('/extensions/{vehicleExtension}', [VehicleExtensionController::class, 'adminDestroy'])->name('vehicles.extensions.destroy');

        // Borrow Vehicles (Vehicle Details)
        Route::get('/{vehicle}/history', [VehicleDetailController::class, 'index'])->name('vehicles.borrowing.history');
        Route::get('/{vehicle}/borrow', [VehicleDetailController::class, 'show'])->name('vehicles.borrow');
        Route::post('/{vehicle}/borrow', [VehicleDetailController::class, 'store'])->name('vehicles.borrow.store');
        Route::put('/{vehicleDetail}/return', [VehicleDetailController::class, 'update'])->name('vehicles.return');
    });
    Route::resource('vehicles', VehicleController::class);

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
    Route::prefix('information')->group(function () {
        Route::get('/', [DashboardController::class, 'showInformation'])->name('information.index');

        Route::prefix('inventories')->group(function () {
            Route::get('/', [DashboardController::class, 'showInventories'])->name('information.inventories.index');
            Route::get('/{inventory}', [DashboardController::class, 'showInventoryDetail'])->name('information.inventories.show');
        });

        Route::prefix('vehicles')->group(function () {
            Route::get('/', [DashboardController::class, 'showVehicles'])->name('information.vehicles.index');

            // Vehicle Extensions
            Route::get('/extensions', [VehicleExtensionController::class, 'userIndex'])->name('information.extensions.index');
            Route::get('/extensions/create', [VehicleExtensionController::class, 'userCreate'])->name('information.extensions.create');
            Route::post('/extensions/create', [VehicleExtensionController::class, 'userStore'])->name('information.extensions.store');
            Route::get('/extensions/{vehicleExtension}', [VehicleExtensionController::class, 'userShow'])->name('information.extensions.show');
            Route::delete('/extensions/{vehicleExtension}', [VehicleExtensionController::class, 'userDestroy'])->name('information.extensions.destroy');

            Route::get('/{vehicle}', [DashboardController::class, 'showVehicleDetail'])->name('information.vehicles.show');
        });

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
