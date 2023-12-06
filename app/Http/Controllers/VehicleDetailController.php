<?php

namespace App\Http\Controllers;

use App\Enums\VehicleDetailStatus;
use App\Enums\VehicleStatus;
use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\VehicleDetail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VehicleDetail\StoreVehicleDetailRequest;

class VehicleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : Void
    {
        //
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
    public function store(StoreVehicleDetailRequest $request) : RedirectResponse
    {
        Vehicle::findOrFail($request->vehicle_id)
            ->update([
                'status' => VehicleStatus::DIPINJAM,
                'user_id' => $request->user_id
            ]);

        VehicleDetail::create($request->all());

        return redirect()
            ->route('vehicles.edit', $request->vehicle_id)
            ->with('success', 'Kendaraan berhasil dipinjamkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleDetail  $vehicleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleDetail $vehicleDetail) : Void
    {
        //
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
            ->update(['status' => VehicleStatus::TERSEDIA]);

        return redirect()
            ->route('vehicles.edit', $vehicleDetail->vehicle_id)
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
