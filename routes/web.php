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
    Route::resource('users', UserController::class);
    Route::get('users/{user}/vehicles', [UserController::class, 'showUserVehicles'])->name('users.vehicles');
    Route::get('users/{user}/inventories', [UserController::class, 'showUserInventories'])->name('users.inventories');
    Route::put('users/{user}/change-password', [ProfileController::class, 'userUpdatePassword'])->name('users.password.update');
    Route::get('users/import', [UserController::class, 'import'])->name('users.import.view');
    Route::post('users/import', [UserController::class, 'importHandler'])->name('users.import.handler');
    Route::get('users/export', [UserController::class, 'export'])->name('users.export');

    // Offices
    Route::resource('offices', OfficeController::class);
    Route::get('offices/import', [OfficeController::class, 'import'])->name('offices.import.view');
    Route::post('offices/import', [OfficeController::class, 'importHandler'])->name('offices.import.handler');
    Route::get('offices/export', [OfficeController::class, 'export'])->name('offices.export');

    // Brand
    Route::resource('brands', BrandController::class);
    Route::get('brands/import', [BrandController::class, 'import'])->name('brands.import.view');
    Route::post('brands/import', [BrandController::class, 'importHandler'])->name('brands.import.handler');
    Route::get('brands/export', [BrandController::class, 'export'])->name('brands.export');

    // Inventory
    Route::resource('inventories', InventoryController::class);
    Route::get('inventories/import', [InventoryController::class, 'import'])->name('inventories.import.view');
    Route::post('inventories/import', [InventoryController::class, 'importHandler'])->name('inventories.import.handler');
    Route::get('inventories/export', [InventoryController::class, 'export'])->name('inventories.export');

    // Inventory Detail
    Route::post('inventory/details', [InventoryDetailController::class, 'store'])->name('inventory.details.store');
    Route::put('inventory/{inventoryDetail}', [InventoryDetailController::class, 'update'])->name('inventory.details.update');

    // Vehicle
    Route::get('vehicles/import', [VehicleController::class, 'import'])->name('vehicles.import.view');
    Route::post('vehicles/import', [VehicleController::class, 'importHandler'])->name('vehicles.import.handler');
    Route::get('vehicles/export', [VehicleController::class, 'export'])->name('vehicles.export');

    // Vehicle Report
    Route::get('vehicles/report', [VehicleReportController::class, 'index'])->name('vehicles.report');

    // Vehicle Reminder
    Route::post('vehicles/reminder', [VehicleReminderController::class, 'usersReminder'])->name('vehicles.users.reminder');
    Route::post('vehicles/reminder/{vehicle}', [VehicleReminderController::class, 'userReminder'])->name('vehicles.user.reminder');

    // Vehicle Detail
    Route::post('/vehicle/details', [VehicleDetailController::class, 'store'])->name('vehicle.details.store');
    Route::put('/vehicle/{vehicleDetail}', [VehicleDetailController::class, 'update'])->name('vehicle.details.update');

    Route::resource('vehicles', VehicleController::class);


});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // My Information
    Route::get('/my', [DashboardController::class, 'showMyInformation'])->name('my.information');
    Route::get('/my/inventories', [DashboardController::class, 'showMyInventories'])->name('my.inventories');
    Route::get('/my/inventories/{inventory}', [DashboardController::class, 'showMyInventoryDetail'])->name('my.inventory.detail');
    Route::get('/my/vehicles', [DashboardController::class, 'showMyVehicles'])->name('my.vehicles');
    Route::get('/my/vehicles/{vehicle}', [DashboardController::class, 'showMyVehicleDetail'])->name('my.vehicle.detail');

    // Profile
    Route::get('/my/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/my/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/my/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.edit.password');
    Route::put('/my/profile/change-password', [PasswordController::class, 'profileUpdatePassword'])->name('profile.password.update');
    Route::patch('/my/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/my/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
