<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Inventory;
use Illuminate\View\View;
use App\Enums\VehicleStatus;
use App\Enums\InventoryStatus;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    private function adminDashboard()
    {
        $vehiclesCount = Vehicle::count();
        $borrowedVehiclesCount = Vehicle::where('status', VehicleStatus::DIPINJAM)->count();
        $inventoriesCount = Inventory::count();
        $borrowedInventoriesCount = Inventory::where('status', InventoryStatus::DIPINJAM)->count();
        $usersCount = User::count();

        return view('dashboard.index', compact('vehiclesCount', 'borrowedVehiclesCount', 'inventoriesCount', 'borrowedInventoriesCount', 'usersCount'));
    }

    private function userDashboard()
    {
        return view('dashboard.dashboard');
    }

    public function showInformation(): View
    {
        $userVehiclesCount = Auth::user()->vehicles->count();
        $userInventoriesCount = Auth::user()->inventories->count();

        return view('information.index', compact('userVehiclesCount', 'userInventoriesCount'));
    }

    public function showInventories(): View
    {
        $userInventories = Auth::user()->load('inventories')->inventories;

        return view('information.inventories.index', compact('userInventories'));
    }

    public function showInventoryDetail(Inventory $inventory): View
    {
        return view('information.inventories.show', compact('inventory'));
    }

    public function showVehicles(): View
    {
        $userId = Auth::id();
        $userVehicles = Vehicle::where('user_id', $userId)
            ->paginate(10);

        return view('information.vehicles.index', compact('userVehicles'));
    }

    public function showVehicleDetail(Vehicle $vehicle): View
    {
        return view('information.vehicles.show', compact('vehicle'));
    }
}
