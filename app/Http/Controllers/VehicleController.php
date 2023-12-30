<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Office;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;
use App\Enums\BrandCategory;
use Illuminate\Http\Request;
use App\Models\VehicleDetail;
use App\Enums\VehicleCategory;
use App\Exports\VehiclesExport;
use App\Imports\VehiclesImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;

class VehicleController extends Controller
{
    public function index() : View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $vehicles = Vehicle::with(['brand', 'office'])
            ->sortable()
            ->filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('vehicles.index', [
            'vehicles' => $vehicles,
        ]);
    }

    public function create() : View
    {
        return view('vehicles.create', [
            'offices' => Office::all(),
            'brands' => Brand::where('category', '=', BrandCategory::OTOMOTIF)->get(),
            'categories' => VehicleCategory::cases()
        ]);
    }

    public function store(StoreVehicleRequest $request) : RedirectResponse
    {
        $vehicle = Vehicle::create($request->all());

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('images/vehicles'), $imageName);

            $vehicle->update(
                ['photo' => $imageName]
            );
        }

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function show(Vehicle $vehicle) : View
    {
        return view('vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    public function edit(Vehicle $vehicle) : View
    {
        return view('vehicles.edit', [
            'vehicle' => $vehicle,

            'categories' => VehicleCategory::cases(),
            'brands' => Brand::where('category', '=', BrandCategory::OTOMOTIF)->get(),
            'offices' => Office::all()
        ]);
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle) : RedirectResponse
    {
        $vehicle->update($request->except('photo'));

        if ($request->hasFile('photo')) {
            $filePath = public_path('images/vehicles/' . $vehicle->photo);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('images/vehicles'), $imageName);

            $vehicle->update(
                ['photo' => $imageName]
            );
        }

        return redirect()
            ->route('vehicles.edit', $vehicle->id)
            ->with('success', 'Kendaraan berhasil diperbarui');
    }

    public function destroy(Vehicle $vehicle) : RedirectResponse
    {
        $vehicle->delete();

        VehicleDetail::where('vehicle_id', $vehicle->id)->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus!');
    }

    public function showRecycled(): View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $vehicles = Vehicle::onlyTrashed()
            ->with(['brand', 'office'])
            ->sortable()
            ->filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('vehicles.recycle', [
            'vehicles' => $vehicles,
        ]);
    }

    public function restoreRecycled($id)
    {
        $vehicle = Vehicle::onlyTrashed()->findOrFail($id);
        $vehicle->restore();

        return redirect()
            ->route('vehicles.recycle.show')
            ->with('success', 'Kendaraan berhasil dipulihkan!');
    }

    public function deleteRecycled($id)
    {
        $vehicle = Vehicle::onlyTrashed()->findOrFail($id);

        $filePath = public_path('images/vehicles/' . $vehicle->photo);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $vehicle->forceDelete();

        return redirect()
            ->route('vehicles.recycle.show')
            ->with('success', 'Kendaraan berhasil dihapus permanen!');
    }

    // Import
    public function importExcel(Request $request)
    {
        return view('vehicles.import');
    }

    public function importHandlerExcel(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Process the Excel file
        Excel::import(new VehiclesImport, $file);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Excel file imported successfully!');
    }

    // Excel
    public function exportExcel(){
        $file_name = 'vehicles_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new VehiclesExport, $file_name);
    }

    public function exportPdf(){
        $vehicles = Vehicle::with(['brand', 'office'])->get();

        // $pdf = PDF::loadView('vehicles.pdf-export', compact('vehicles'));

        // $file_name = 'vehicles_'.date('Y_m_d').'.pdf';
        // return $pdf->download($file_name);

        return view('vehicles.pdf-export', [
            'vehicles' => $vehicles
        ]);
    }
}
