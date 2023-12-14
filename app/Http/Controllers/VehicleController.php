<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Office;
use App\Models\Vehicle;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function tax() : View
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an   integer between 1 and 100.');
        }

        $vehicles = Vehicle::with(['user'])
            ->filter(request(['search']))
            ->whereDate('tax_period', '<', now()->addMonth()) // Filter tax_period < (waktu sekarang + 1 bulan)
            ->paginate($perPage)
            ->appends(request()->query());

        return view('vehicles.tax', [
            'vehicles' => $vehicles,
        ]);
    }

    public function stnk() : View
    {
        $perPage = (int) request('row', 10);

        if ($perPage < 1 || $perPage > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $vehicles = Vehicle::filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('vehicles.due', [
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
        return view('vehicles.create', [
            'offices' => Office::all(),
            'brands' => Brand::where('category', '=', BrandCategory::OTOMOTIF)->get(),
            'categories' => VehicleCategory::cases()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle) : View
    {
        $vehicle_details = VehicleDetail::with(['user'])
            ->where('vehicle_id', $vehicle->id)
            ->orderByDesc('id')
            ->get();

        return view('vehicles.show', [
            'vehicle' => $vehicle,
            'vehicle_details' => $vehicle_details,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle) : View
    {
        $vehicle_details = VehicleDetail::with(['user'])
            ->where('vehicle_id', $vehicle->id)
            ->orderByDesc('id')
            ->get();

        $vehicle_detail_current = $vehicle_details->first() ?? 0 ;

        return view('vehicles.edit', [
            'vehicle' => $vehicle,
            'vehicle_details' => $vehicle_details,
            'vehicle_detail_current' => $vehicle_detail_current,

            'categories' => VehicleCategory::cases(),
            'brands' => Brand::where('category', '=', BrandCategory::OTOMOTIF)->get(),
            'offices' => Office::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle) : RedirectResponse
    {
        // Menggunakan metode delete() pada instance model $vehicle untuk menghapus data
        $vehicle->delete();

        // Menggunakan metode where() dengan operator '=' untuk mencari data yang sesuai
        VehicleDetail::where('vehicle_id', $vehicle->id)->delete();

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus!');
    }

    // Import Excel
    public function import(Request $request)
    {
        return view('vehicles.import');
    }

    public function importHandler(Request $request)
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

    // Excel Export
    public function export(){
        $file_name = 'vehicles_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new VehiclesExport, $file_name);
    }
}
