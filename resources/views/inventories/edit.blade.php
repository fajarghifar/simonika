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

        <x-alert/>

        <form class="row" action="{{ route('inventories.update', $inventory) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

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

                                <div class="small font-italic text-muted mb-2">
                                    JPG or PNG no larger than 2 MB
                                </div>

                                <input
                                    type="file"
                                    accept="image/*"
                                    id="image"
                                    name="photo"
                                    class="form-control @error('photo') is-invalid @enderror"
                                    onchange="previewImage();"
                                >

                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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
                                {{ __('Edit Inventaris') }}
                            </h3>
                        </div>

                        <div class="card-actions">
                            <x-action.close route="{{ route('inventories.index') }}" />
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-6">
                                <x-input.select name="brand_id"
                                                label="Brand"
                                                placeholder="{{ __('Pilih brand:') }}"
                                >
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @if(old('brand_id', $inventory->brand_id) == $brand->id) selected="selected" @endif>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-lg-6">
                                <x-input.select name="category"
                                                label="Kategori"
                                                placeholder="{{ __('Pilih kategori:') }}"
                                >
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->value }}" @if(old('category', $inventory->category->value) == $category->value) selected="selected" @endif>{{ $category->label() }}</option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-lg-12">
                                <x-input name="model"
                                        label="Model"
                                        placeholder="Model"
                                        value="{{ old('model', $inventory->model) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-lg-6">
                                <x-input name="serial_number"
                                        label="Nomor Seri"
                                        placeholder="Nomor seri"
                                        value="{{ old('serial_number', $inventory->serial_number) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('Tanggal Pembelian') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="purchased_date" type="date"
                                        class="form-control @error('purchased_date') is-invalid @enderror"
                                        value="{{ old('purchased_date', $inventory->purchased_date ? \Carbon\Carbon::parse($inventory->purchased_date)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                                        required
                                    >

                                    @error('purchased_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <x-input.select name="office_id"
                                                label="Kantor"
                                                placeholder="{{ __('Pilih kantor:') }}"
                                >
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}" @if(old('office_id', $inventory->office_id) == $office->id) selected="selected" @endif>
                                            {{ $office->code }} - {{ $office->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                    </label>

                                    <span class="btn position-relative btn-{{ $inventory->status === \App\Enums\InventoryStatus::TERSEDIA ? 'green' : 'orange' }}">{{ $inventory->status->label() }}<span class="badge bg-{{ $inventory->status === \App\Enums\InventoryStatus::TERSEDIA ? 'green' : 'orange' }} badge-notification badge-blink"></span></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit">
                            {{ __('Update') }}
                        </x-button.save>
                        <x-button class="btn btn-warning" route="{{ route('inventories.index') }}">
                            {{ __('Kembali') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@push('page-scripts')
    <script src="{{ asset('dist/js/img-preview.js') }}"></script>
@endpush
