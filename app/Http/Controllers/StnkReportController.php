<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class StnkReportController extends Controller
{
    public function weeklyStnkReport()
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $vehicles = Vehicle::with(['user'])
            ->filter(request(['search']))
            ->whereDate('stnk_period', '<', now()->addWeek())
            ->orderBy('stnk_period','ASC')
            ->paginate($perPage);

        return view('vehicles.stnk', [
            'vehicles' => $vehicles,
            'search' => route('vehicles.weekly.stnk.report')
        ]);
    }

    public function monthlyStnkReport()
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $vehicles = Vehicle::with(['user'])
            ->filter(request(['search']))
            ->whereDate('stnk_period', '<', now()->addMonth())
            ->orderBy('stnk_period','ASC')
            ->paginate($perPage);

        return view('vehicles.stnk', [
            'vehicles' => $vehicles,
            'search' => route('vehicles.monthly.stnk.report')
        ]);
    }
}
