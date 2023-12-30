@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ $inventory->model }}
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
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Foto') }}
                                </h3>
                                <img class="img-fluid rounded mx-auto d-block mb-2"
                                    style="max-width: 250px"
                                    src="{{ $inventory->photo ? asset('images/inventories/'.$inventory->photo) : asset('static/product.webp') }}"
                                    id="image-preview"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Peminjaman') }}
                                </h3>
                                <div class="medium font-italic text-muted mb-2">
                                    Lakukan peminjaman atau tampilkan riwayat peminjaman pada inventaris ini.
                                </div>
                                <div class="row">
                                    <div class="col-6 py-3">
                                        <a class="btn btn-outline-info w-100" href="{{ route('inventories.borrow', $inventory) }}">
                                            {{ __('Peminjaman') }}
                                        </a>
                                    </div>
                                    <div class="col-6 py-3">
                                        <a class="btn btn-outline-warning w-100" href="{{ route('inventories.borrowing.history', $inventory) }}">
                                            {{ __('Riwayat') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Detail Inventaris') }}
                            </h3>
                        </div>

                        <div class="card-actions">
                            <x-action.close route="{{ route('inventories.index') }}" />
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="label mb-1">Brand</label>
                                <p class="form-control form-control-solid ">{{ $inventory->brand->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Kategori</label>
                                <p class="form-control form-control-solid ">{{ $inventory->category->label() }}</p>
                            </div>

                            <div class="col-lg-12">
                                <label class="label mb-1">Model</label>
                                <p class="form-control form-control-solid ">{{ $inventory->model }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Nomor Seri</label>
                                <p class="form-control form-control-solid ">{{ $inventory->serial_number }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Tanggal Pembelian</label>
                                <p class="form-control form-control-solid ">{{ \Carbon\Carbon::parse($inventory->purchased_date)->format('d M Y') }}</p>
                            </div>

                            <div class="col-lg-6">
                                <label class="label mb-1">Kantor</label>
                                <p class="form-control form-control-solid ">{{ $inventory->office->name }}</p>
                            </div>
                            <div class="col-lg-6">
                                <label class="label mb-1">Status</label>
                                <p>
                                    <span class="btn position-relative btn-{{ $inventory->status === \App\Enums\InventoryStatus::TERSEDIA ? 'green' : 'orange' }}">{{ $inventory->status->label() }}<span class="badge bg-{{ $inventory->status === \App\Enums\InventoryStatus::TERSEDIA ? 'green' : 'orange' }} badge-notification badge-blink"></span></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button class="btn btn-info" route="{{ route('inventories.edit', $inventory) }}">
                            {{ __('Edit') }}
                        </x-button>
                        <x-button class="btn btn-warning" route="{{ route('inventories.index') }}">
                            {{ __('Kembali') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
