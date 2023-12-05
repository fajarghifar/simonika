<?php

namespace App\Http\Controllers;

use App\Enums\InventoryDetailStatus;
use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Enums\InventoryStatus;
use App\Models\InventoryDetail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InventoryDetail\StoreInventoryDetailRequest;

class InventoryDetailController extends Controller
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
    public function store(StoreInventoryDetailRequest $request) : RedirectResponse
    {
        Inventory::findOrFail($request->inventory_id)
            ->update([
                'status' => InventoryStatus::DIPINJAM,
                'user_id' => $request->user_id
            ]);

        InventoryDetail::create($request->all());

        return redirect()
            ->route('inventories.edit', $request->inventory_id)
            ->with('success', 'Inventaris berhasil dipinjam!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryDetail  $inventoryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryDetail $inventoryDetail) : Void
    {
        //
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
        $rules = [
            'id' => [
                'required',
                'string',
                'exists:inventory_details,id'
            ]
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = InventoryDetailStatus::KEMBALI;
        $validatedData['returned_date'] = Carbon::now()->format('Y-m-d');

        $inventory_detail = InventoryDetail::where('id', $validatedData['id'])->first();

        InventoryDetail::findOrFail($inventory_detail->id)
                    ->update($validatedData);

        Inventory::findOrFail($inventory_detail->inventory_id)
                    ->update(['status' => InventoryStatus::TERSEDIA]);

        return redirect()
            ->route('inventories.edit', $inventory_detail->inventory_id)
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
