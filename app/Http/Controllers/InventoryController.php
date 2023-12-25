<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Office;
use App\Models\Inventory;
use Illuminate\View\View;
use App\Enums\BrandCategory;
use Illuminate\Http\Request;
use App\Models\InventoryDetail;
use App\Enums\InventoryCategory;
use App\Exports\InventoriesExport;
use App\Imports\InventoriesImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Inventory\StoreInventoryRequest;
use App\Http\Requests\Inventory\UpdateInventoryRequest;

class InventoryController extends Controller
{
    public function index(): View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $inventories = Inventory::with(['brand', 'office'])
            ->sortable()
            ->filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('inventories.index', compact('inventories'));
    }

    public function create()  : View
    {
        return view('inventories.create', [
            'users' => User::all(),
            'categories' => InventoryCategory::cases(),
            'brands' => Brand::where('category', '=', BrandCategory::ELEKTRONIK)->get(),
            'offices' => Office::all(),
        ]);
    }

    public function store(StoreInventoryRequest $request) : RedirectResponse
    {
        $inventory = Inventory::create($request->all());

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('images/inventories'), $imageName);

            $inventory->update(
                ['photo' => $imageName]
            );
        }

        return redirect()
            ->route('inventories.index')
            ->with('success', 'Inventaris berhasil ditambahkan!');
    }

    public function show(Inventory $inventory)  : View
    {
        $inventory_details = InventoryDetail::with(['user'])
            ->where('inventory_id', $inventory->id)
            ->orderByDesc('id')
            ->get();

        return view('inventories.show', [
            'inventory' => $inventory,
            'inventory_details' => $inventory_details,
        ]);
    }

    public function edit(Inventory $inventory) : View
    {
        $inventory_details = InventoryDetail::with(['user'])
            ->where('inventory_id', $inventory->id)
            ->orderByDesc('id')
            ->get();

        $inventory_detail_current = $inventory_details->first() ?? 0 ;

        return view('inventories.edit', [
            'inventory' => $inventory,
            'inventory_details' => $inventory_details,
            'inventory_detail_current' => $inventory_detail_current,

            'categories' => InventoryCategory::cases(),
            'brands' => Brand::where('category', '=', BrandCategory::ELEKTRONIK)->get(),
            'offices' => Office::all(),
            'users' => User::all(),
        ]);
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory) : RedirectResponse
    {
        $inventory->update($request->except('photo'));

        if ($request->hasFile('photo')) {
            $filePath = public_path('images/inventories/' . $inventory->photo);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $image = $request->file('photo');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->move(public_path('images/inventories'), $imageName);

            $inventory->update(
                ['photo' => $imageName]
            );
        }

        return redirect()
            ->route('inventories.edit', $inventory->id)
            ->with('success', 'Inventaris berhasil diperbarui!');
    }

    public function destroy(Inventory $inventory) : RedirectResponse
    {
        $inventory->delete();
        InventoryDetail::where('inventory_id', $inventory->id)->delete();

        return redirect()
            ->route('inventories.index')
            ->with('success', 'Inventaris berhasil dihapus!');
    }

    public function showRecycled(): View
    {
        $perPage = (int) request('row', 10);

        abort_if($perPage < 1 || $perPage > 25, 404);

        $inventories = Inventory::onlyTrashed()
            ->with(['brand', 'office'])
            ->sortable()
            ->filter(request(['search']))
            ->paginate($perPage)
            ->appends(request()->query());

        return view('inventories.recycle', compact('inventories'));
    }

    public function restoreRecycled($id)
    {
        $inventory = Inventory::onlyTrashed()->findOrFail($id);
        $inventory->restore();

        return redirect()
            ->route('inventories.recycle.show')
            ->with('success', 'Inventaris berhasil dipulihkan!');
    }

    public function deleteRecycled($id)
    {
        $inventory = Inventory::onlyTrashed()->findOrFail($id);

        $filePath = public_path('images/inventories/' . $inventory->photo);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $inventory->forceDelete();

        return redirect()
            ->route('inventories.recycle.show')
            ->with('success', 'Inventaris berhasil dihapus permanen!');
    }

    public function import(Request $request)
    {
        return view('inventories.import');
    }

    public function importHandler(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);


        $file = $request->file('file');


        Excel::import(new InventoriesImport, $file);

        return redirect()
            ->route('inventories.index')
            ->with('success', 'Excel file imported successfully!');
    }

    public function export(){
        $file_name = 'inventories_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new InventoriesExport, $file_name);
    }
}
