<?php

namespace App\Http\Controllers;

use App\Enums\InventoryStatus;
use App\Enums\VehicleStatus;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Inventory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::count();
        $inventories = Inventory::count();
        $users = User::count();

        $borrowed_vehicles = Vehicle::query()
            ->where('status', '=', VehicleStatus::DIPINJAM)
            ->count();
        $borrowed_inventories = Inventory::query()
            ->where('status', '=', InventoryStatus::DIPINJAM)
            ->count();

        return view('dashboard.index', [
            'vehicles' => $vehicles,
            'borrowed_vehicles' => $borrowed_vehicles,
            'inventories' => $inventories,
            'borrowed_inventories' => $borrowed_inventories,
            'users' => $users
        ]);
    }
}
