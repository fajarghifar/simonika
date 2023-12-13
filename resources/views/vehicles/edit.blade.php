@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <form class="row" action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
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

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Edit Kendaraan') }}
                            </h3>
                        </div>

                        <div class="card-actions">
                            <x-action.close route="{{ route('vehicles.index') }}" />
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <x-input.select name="brand_id"
                                                label="Brand"
                                                placeholder="{{ __('Pilih brand:') }}"
                                >
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" @if(old('brand_id', $vehicle->brand_id) == $brand->id) selected="selected" @endif>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input.select name="category"
                                                label="Kategori"
                                                placeholder="{{ __('Pilih kategori:') }}"
                                >
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->value }}" @if(old('category', $vehicle->category->value) == $category->value) selected="selected" @endif>{{ $category->label() }}</option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-md-12">
                                <x-input name="model"
                                        label="Model"
                                        placeholder="Model"
                                        value="{{ old('model', $vehicle->model) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="year"
                                        label="Tahun Pembuatan"
                                        placeholder="Tahun pembuatan"
                                        value="{{ old('year', $vehicle->year) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="license_plate"
                                        label="Nomor Polisi"
                                        placeholder="Nomor polisi"
                                        value="{{ old('license_plate', $vehicle->license_plate) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="stnk_number"
                                        label="Nomor STNK"
                                        placeholder="Nomor STNK"
                                        value="{{ old('stnk_number', $vehicle->stnk_number) }}"
                                        required="true"
                                />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="bpkb_number"
                                        label="Nomor BPKB"
                                        placeholder="Nomor BPKB"
                                        value="{{ old('bpkb_number', $vehicle->bpkb_number) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="chassis_number"
                                        label="Nomor Rangka"
                                        placeholder="Nomor rangka"
                                        value="{{ old('chassis_number', $vehicle->chassis_number) }}"
                                        required="true"
                                />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="engine_number"
                                        label="Nomor Mesin"
                                        placeholder="Nomor mesin"
                                        value="{{ old('engine_number', $vehicle->engine_number) }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label for="stnk_period" class="form-label">
                                        {{ __('Masa Berlaku STNK') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="stnk_period" id="stnk_period" type="date"
                                        class="form-control @error('stnk_period') is-invalid @enderror"
                                        value="{{ old('stnk_period', $vehicle->stnk_period ? \Carbon\Carbon::parse($vehicle->stnk_period)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                                        required
                                    >

                                    @error('stnk_period')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label for="tax_period" class="form-label">
                                        {{ __('Masa Berlaku Pajak') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="tax_period" id="tax_period" type="date"
                                        class="form-control @error('tax_period') is-invalid @enderror"
                                        value="{{ old('tax_period', $vehicle->tax_period ? \Carbon\Carbon::parse($vehicle->tax_period)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                                        required
                                    >

                                    @error('tax_period')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input.select name="office_id"
                                                label="Kantor"
                                                placeholder="{{ __('Pilih kantor:') }}"
                                >
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id }}" @if(old('office_id', $vehicle->office_id) == $office->id) selected="selected" @endif>
                                            {{ $office->code }} - {{ $office->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                    </label>

                                    <x-status
                                        dot color="{{ $vehicle->status === \App\Enums\VehicleStatus::TERSEDIA ? 'green' : 'orange' }}"
                                        class="text-uppercase"
                                    >
                                        {{ $vehicle->status->label() }}
                                    </x-status>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit">
                            {{ __('Update') }}
                        </x-button.save>

                        <a class="btn btn-warning" href="{{ route('vehicles.index') }}">
                            {{ __('Batal') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>

        @if ($vehicle_detail_current && $vehicle_detail_current->status == \App\Enums\VehicleDetailStatus::PINJAM)
        <form class="row" action="{{ route('vehicle.details.update', $vehicle_detail_current->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="col-lg-4 mb-3"></div>

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Data Peminjaman') }}
                            </h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 col-md-6">
                                <x-input name="user_id"
                                            label="Nama Pengguna"
                                            value="{{ $vehicle_detail_current->user->name }}"
                                            readonly="true"
                                />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="borrowed_date"
                                            label="Tanggal Pinjam"
                                            value="{{ $vehicle_detail_current->borrowed_date }}"
                                            readonly="true"
                                />
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit">
                            {{ __('Kembali') }}
                        </x-button.save>
                    </div>
                </div>
            </div>
        </form>
        @else
        <form action="{{ route('vehicle.details.store') }}" class="row" method="POST">
            @csrf
            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}" required>

            <div class="col-lg-4 mb-3"></div>

            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Data Peminjaman') }}
                            </h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-cards">

                            <div class="col-sm-6 col-md-6">
                                <x-input.select name="user_id"
                                                label="Nama Pengguna"
                                                placeholder="{{ __('Pilih pengguna:') }}"
                                >
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('Tanggal Pinjam') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="borrowed_date" type="date"
                                        class="form-control @error('borrowed_date') is-invalid @enderror"
                                        value="{{ old('borrowed_date') }}"
                                        required
                                    >

                                    @error('borrowed_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit">
                            {{ __('Simpan') }}
                        </x-button.save>

                        <a class="btn btn-warning" href="{{ route('vehicles.index') }}">
                            {{ __('Batal') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
        @endif

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Riwayat Inventaris') }}
                    </h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center w-1">
                                {{ __('No') }}
                            </th>
                            <th  scope="col" class="align-middle text-center">
                                {{ __('Nama') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Tanggal Pinjam') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Tanggal Kembali') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Status') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vehicle_details as $log)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="align-middle text-center">
                                {{ $log->user->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $log->borrowed_date }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $log->returned_date }}
                            </td>
                            <td class="align-middle text-center">
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
                                    <div class="empty-icon">
                                        <x-icon.sad/>
                                    </div>
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

@push('page-scripts')
    <script src="{{ asset('dist/js/img-preview.js') }}"></script>
@endpush
