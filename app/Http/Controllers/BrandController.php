<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\View\View;
use App\Enums\BrandCategory;
use Illuminate\Http\Request;
use App\Exports\BrandsExport;
use App\Imports\BrandsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400);
        }

        $brands = Brand::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('brands.index', [
            'brands' => $brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() : View
    {
        return view('brands.create', [
            'categories' => BrandCategory::cases()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request) : RedirectResponse
    {
        Brand::create($request->all());

        return redirect()
                ->route('brands.index')
                ->with('success', 'Brand berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand) : View
    {
        return view('brands.show', [
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand) : View
    {
        return view('brands.edit', [
            'brand' => $brand,
            'categories' => BrandCategory::cases()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand) : RedirectResponse
    {
        $brand->update($request->all());

        return redirect()
            ->route('brands.edit', $brand->id)
            ->with('success', 'Brand berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        // if ($brand->inventories()->exists() || $brand->vehicles()->exists()) {
        //     return redirect()
        //         ->route('brands.index')
        //         ->with('error', 'Brand terkait dengan inventaris/kendaraan dan tidak dapat dihapus.');
        // }

        $brand->delete();

        return redirect()
            ->back()
            ->with('success', 'Brand berhasil dihapus!');
    }

    // Import Excel
    public function import(Request $request)
    {
        return view('brands.import');
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
        Excel::import(new BrandsImport, $file);

        return redirect()
            ->route('brands.index')
            ->with('success', 'Berkas excel berhasil diimport!');
    }

    // Excel Export
    public function export(){
        $file_name = 'brands_'.date('Y_m_d_H_i_s').'.xlsx';
        return Excel::download(new BrandsExport, $file_name);
    }
}
