<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class TaxReportController extends Controller
{
    public function weeklyTaxReport()
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $vehicles = Vehicle::with(['user'])
            ->filter(request(['search']))
            ->whereDate('tax_period', '<', now()->addWeek())
            ->orderBy('tax_period','ASC')
            ->paginate($perPage);

        return view('vehicles.tax', [
            'vehicles' => $vehicles,
            'search' => route('vehicles.weekly.tax.report')
        ]);
    }

    public function monthlyTaxReport()
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $vehicles = Vehicle::with(['user'])
            ->filter(request(['search']))
            ->whereDate('tax_period', '<', now()->addMonth())
            ->orderBy('tax_period','ASC')
            ->paginate($perPage);

        return view('vehicles.tax', [
            'vehicles' => $vehicles,
            'search' => route('vehicles.monthly.tax.report')
        ]);
    }
}
