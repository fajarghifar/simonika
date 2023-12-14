<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\OfficesExport;
use App\Imports\OfficesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Office\StoreOfficeRequest;
use App\Http\Requests\Office\UpdateOfficeRequest;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 25) {
            abort(400);
        }

        $offices = Office::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('offices.index', [
            'offices' => $offices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
        return view('offices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfficeRequest $request) : RedirectResponse
    {
        Office::create($request->validated());

        return redirect()
                ->route('offices.index')
                ->with('success', 'Kantor berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office) : View
    {
        return view('offices.show', [
            'office' => $office
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office) : View
    {
        return view('offices.edit', [
            'office' => $office
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfficeRequest $request, Office $office)  : RedirectResponse
    {
        $office->update($request->all());

        return redirect()
            ->route('offices.index')
            ->with('success', 'Kantor berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)  : RedirectResponse
    {
        // if ($office->inventories()->exists() || $office->vehicles()->exists()) {
        //     return redirect()
        //         ->route('offices.index')
        //         ->with('error', 'Kantor terkait dengan inventaris/kendaraan dan tidak dapat dihapus.');
        // }

        $office->delete();

        return redirect()
            ->back()
            ->with('success', 'Kantor berhasil dihapus!');
    }

    // Import Excel
    public function import(Request $request)
    {
        return view('offices.import');
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
        Excel::import(new OfficesImport, $file);

        return redirect()
            ->route('offices.index')
            ->with('success', 'Berkas excel berhasil diimport!');
    }

    // Excel Export
    public function export(){
        $file_name = 'offices_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new OfficesExport, $file_name);
    }
}
