<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\View\View;
use App\Models\VehicleExtension;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Enums\VehicleExtensionStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VehicleExtension\StoreVehicleExtensionRequest;

class VehicleExtensionController extends Controller
{
    public function userIndex() : View
    {
        $perPage = (int) request('row', 10);
        $userId = Auth::id();

        abort_if($perPage < 1 || $perPage > 25, 404);

        $extensions = VehicleExtension::with(['vehicle', 'approvedBy'])
            ->where('requested_by', $userId)
            ->sortable()
            ->paginate($perPage);

        return view('information.extensions.index', compact('extensions'));
    }

    public function userCreate(): View
    {
        $userId = Auth::id();
        $vehicles = Vehicle::where('user_id', $userId)->get();

        return view('information.extensions.create', [
            'vehicles' => $vehicles,
        ]);
    }

    public function userStore(StoreVehicleExtensionRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $userId = Auth::id();
        $validatedData['requested_by'] = $userId;

        // Handle Upload Document
        $document = $request->file('document');
        $documentName = hexdec(uniqid()) . '.' . $document->getClientOriginalExtension();
        $documentPath = $document->move(public_path('documents'), $documentName);

        $validatedData['document'] = $documentName;

        VehicleExtension::create($validatedData);

        return redirect()
            ->route('information.extensions.index')
            ->with('success', 'Permohonan perpanjang kendaraan berhasil diajukan!');
    }

    public function userDestroy(VehicleExtension $vehicleExtension): RedirectResponse
    {
        $currentUserId = Auth::id();

        if ($vehicleExtension->requested_by != $currentUserId) {
            return redirect()
                ->back()
                ->with('error', 'Permohonan perpanjang kendaraan gagal dihapus!');
        }

        // Delete file document
        $filePath = public_path('documents/' . $vehicleExtension->document);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $vehicleExtension->delete();

        return redirect()
            ->back()
            ->with('success', 'Permohonan perpanjang kendaraan berhasil dihapus!');
    }

    public function userShow(VehicleExtension $vehicleExtension) : View
    {
        return view('information.extensions.show', [
            'extension' => $vehicleExtension
        ]);
    }

    public function adminIndex() : View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $extensions = VehicleExtension::with(['vehicle', 'approvedBy'])
            ->sortable()
            ->paginate($perPage);

        return view('vehicles.extensions.index', compact('extensions'));
    }

    public function adminShow(VehicleExtension $vehicleExtension) : View
    {
        return view('vehicles.extensions.show', [
            'extension' => $vehicleExtension
        ]);
    }

    public function adminUpdate(VehicleExtension $vehicleExtension) : RedirectResponse
    {
        $userId = Auth::id();
        $vehicleExtension->update([
            'approved_by' => $userId,
            'status' => VehicleExtensionStatus::APPROVED,
        ]);

        Vehicle::findOrFail($vehicleExtension->vehicle_id)
            ->update([
                'tax_period' => $vehicleExtension->tax_period,
                'stnk_period' => $vehicleExtension->stnk_period
            ]);

        return redirect()
            ->route('vehicles.extensions.index')
            ->with('success', 'Permohonan perpanjang kendaraan berhasil disetujui!');
    }

    public function adminDestroy(VehicleExtension $vehicleExtension): RedirectResponse
    {
        // Delete file document
        $filePath = public_path('documents/' . $vehicleExtension->document);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $vehicleExtension->delete();

        return redirect()
            ->back()
            ->with('success', 'Permohonan perpanjang kendaraan berhasil dihapus!');
    }
}
