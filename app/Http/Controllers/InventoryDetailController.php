<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inventory;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Enums\InventoryStatus;
use App\Models\InventoryDetail;
use App\Enums\InventoryDetailStatus;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InventoryDetail\StoreInventoryDetailRequest;

class InventoryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inventory $inventory) : View
    {
        $inventory_details = InventoryDetail::with(['user'])
            ->where('inventory_id', $inventory->id)
            ->orderByDesc('id')
            ->get();

        return view('inventories.history', [
            'inventory' => $inventory,
            'inventory_details' => $inventory_details,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *S
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
    public function store(StoreInventoryDetailRequest $request, Inventory $inventory) : RedirectResponse
    {
        $inventory->update([
                'status' => InventoryStatus::DIPINJAM,
                'user_id' => $request->user_id
            ]);

        InventoryDetail::create(array_merge($request->all(), ['inventory_id' => $inventory->id]));

        return redirect()
            ->route('inventories.show', $inventory)
            ->with('success', 'Inventaris berhasil dipinjam!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryDetail  $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory) : View
    {
        $inventory_details = InventoryDetail::with(['user'])
            ->where('inventory_id', $inventory->id)
            ->orderByDesc('id')
            ->get();

        $inventory_detail_current = $inventory_details->first() ?? 0 ;

        return view('inventories.borrow', [
            'inventory' => $inventory,
            'inventory_detail_current' => $inventory_detail_current,

            'users' => User::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InventoryDetail  $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryDetail $inventoryDetail) : Void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InventoryDetail  $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryDetail $inventoryDetail) : RedirectResponse
    {
        $inventoryDetail->update([
                'status' => InventoryDetailStatus::KEMBALI,
                'returned_date' => now()->format('Y-m-d'),
            ]);

        Inventory::findOrFail($inventoryDetail->inventory_id)->update([
                'status' => InventoryStatus::TERSEDIA,
                'user_id' => null
            ]);

        return redirect()
            ->route('inventories.show', $inventoryDetail)
            ->with('success', 'Inventaris berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InventoryDetail  $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryDetail $inventoryDetail) : Void
    {
        //
    }
}
