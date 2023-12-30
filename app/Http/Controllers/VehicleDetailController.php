<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\View\View;
use App\Enums\VehicleStatus;
use Illuminate\Http\Request;
use App\Models\VehicleDetail;
use App\Enums\VehicleDetailStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VehicleDetail\StoreVehicleDetailRequest;

class VehicleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Vehicle $vehicle) : View
    {
        $vehicle_details = VehicleDetail::with(['user'])
            ->where('vehicle_id', $vehicle->id)
            ->orderByDesc('id')
            ->get();

        return view('vehicles.history', [
            'vehicle' => $vehicle,
            'vehicle_details' => $vehicle_details,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : Void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleDetailRequest $request, Vehicle $vehicle) : RedirectResponse
    {
        $vehicle->update([
                'status' => VehicleStatus::DIPINJAM,
                'user_id' => $request->user_id
            ]);

        VehicleDetail::create(array_merge($request->all(), ['vehicle_id' => $vehicle->id]));

        return redirect()
            ->route('vehicles.show', $vehicle)
            ->with('success', 'Kendaraan berhasil dipinjamkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleDetail  $vehicleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle) : View
    {
        $vehicle_details = VehicleDetail::with(['user'])
            ->where('vehicle_id', $vehicle->id)
            ->orderByDesc('id')
            ->get();

        $vehicle_detail_current = $vehicle_details->first() ?? 0 ;

        return view('vehicles.borrow', [
            'vehicle' => $vehicle,
            'vehicle_detail_current' => $vehicle_detail_current,

            'users' => User::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleDetail  $vehicleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleDetail $vehicleDetail) : Void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleDetail  $vehicleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleDetail $vehicleDetail) : RedirectResponse
    {
        $vehicleDetail->update([
            'status' => VehicleDetailStatus::KEMBALI,
            'returned_date' => now()->format('Y-m-d'),
        ]);

        Vehicle::findOrFail($vehicleDetail->vehicle_id)
            ->update([
                'status' => VehicleStatus::TERSEDIA,
                'user_id' => null
            ]);

        return redirect()
            ->route('vehicles.show', $vehicleDetail->vehicle_id)
            ->with('success', 'Kendaraan berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleDetail  $vehicleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleDetail $vehicleDetail) : Void
    {
        //
    }
}
