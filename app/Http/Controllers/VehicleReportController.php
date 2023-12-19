<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleReportController extends Controller
{
    public function index()
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $vehicles = Vehicle::with(['user'])
            ->filter(request(['search']))
            ->whereDate('tax_period', '<', now()->addMonth())
            ->orWhereDate('stnk_period', '<', now()->addMonth())
            ->paginate($perPage);

        return view('vehicles.report', [
            'vehicles' => $vehicles,
            'search' => route('vehicles.report')
        ]);
    }
}
