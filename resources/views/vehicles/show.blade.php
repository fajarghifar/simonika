@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ $vehicle->model }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards">
            <div class="col-lg-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ __('Foto') }}
                        </h3>
                        <img class="img-fluid rounded mx-auto d-block mb-2"
                            style="max-width: 250px"
                            src="{{ $vehicle->photo ? asset('images/vehicles/'.$vehicle->photo) : asset('static/product.webp') }}"
                            id="image-preview"
                        />
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Detail Kendaraan') }}
                            </h3>
                        </div>

                        <div class="card-actions">
                            <x-action.close route="{{ route('vehicles.index') }}" />
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="label mb-1">Brand</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->brand->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Kategori</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->category->label() }}</p>
                            </div>

                            <div class="col-lg-12">
                                <label class="label mb-1">Model</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->model }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Tahun Pembuatan</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->year }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Nomor Polisi</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->license_plate }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Nomor STNK</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->stnk_number }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Nomor BPKB</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->bpkb_number }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Nomor Rangka</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->chassis_number }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Nomor Mesin</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->engine_number }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Periode STNK</label>
                                <p class="form-control form-control-solid ">{{ \Carbon\Carbon::parse($vehicle->stnk_period)->format('d M Y') }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Periode Pajak</label>
                                <p class="form-control form-control-solid ">{{ \Carbon\Carbon::parse($vehicle->tax_period)->format('d M Y') }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Kantor</label>
                                <p class="form-control form-control-solid ">{{ $vehicle->office->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Status</label>
                                <p>
                                    <x-status
                                        dot color="{{ $vehicle->status === \App\Enums\VehicleStatus::TERSEDIA ? 'green' : 'orange' }}"
                                        class="text-uppercase"
                                    >
                                        {{ $vehicle->status->label() }}
                                    </x-status>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a class="btn btn-info" href="{{ route('vehicles.edit', $vehicle) }}">
                            {{ __('Edit') }}
                        </a>
                        <x-button class="btn btn-warning" route="{{ route('vehicles.index') }}">
                            {{ __('Kembali') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Riwayat') }}
                    </h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-vcenter card-table text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle w-1">
                                {{ __('No') }}
                            </th>
                            <th  scope="col" class="align-middle">
                                {{ __('Nama') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Tanggal Pinjam') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Tanggal Kembali') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Status') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vehicle_details as $log)
                        <tr>
                            <td class="align-middle">
                                {{ $loop->iteration }}
                            </td>

                            <td class="align-middle">
                                {{ $log->user->name }}
                            </td>
                            <td class="align-middle">
                                {{ $log->borrowed_date }}
                            </td>
                            <td class="align-middle">
                                {{ $log->returned_date }}
                            </td>
                            <td class="align-middle">
                                <x-status
                                    dot color="{{ $log->status === \App\Enums\VehicleDetailStatus::KEMBALI ? 'green' : 'orange' }}"
                                    class="text-uppercase"
                                >
                                    {{ $log->status->label() }}
                                </x-status>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
                                <div class="empty">
                                    <p class="empty-title">
                                        Tidak ada riwayat peminjaman!
                                    </p>
                                    <p class="empty-subtitle text-secondary">
                                        Barang ini belum pernah dipinjamkan, sehingga tidak memiliki riwayat peminjaman.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
