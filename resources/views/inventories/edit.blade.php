@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <form class="row" action="{{ route('inventories.update', $inventory) }}" method="POST" enctype="multipart/form-data">
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

                                    <x-status
                                        dot color="{{ $inventory->status === \App\Enums\InventoryStatus::TERSEDIA ? 'green' : 'orange' }}"
                                        class="text-uppercase"
                                    >
                                        {{ $inventory->status->label() }}
                                    </x-status>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit">
                            {{ __('Update') }}
                        </x-button.save>

                        <a class="btn btn-warning" href="{{ route('inventories.index') }}">
                            {{ __('Batal') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>

        @if ($inventory_detail_current && $inventory_detail_current->status == \App\Enums\InventoryDetailStatus::PINJAM)
        <form class="row" action="{{ route('inventory.details.update', $inventory_detail_current->id) }}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{ $inventory_detail_current->id }}"/>

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
                                <x-input name="user_id"
                                            label="Nama Pengguna"
                                            value="{{ $inventory_detail_current->user->name }}"
                                            readonly="true"
                                />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="borrowed_date"
                                            label="Tanggal Pinjam"
                                            value="{{ $inventory_detail_current->borrowed_date }}"
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
        <form action="{{ route('inventory.details.store') }}" class="row" method="POST">
            @csrf
            <input type="hidden" name="inventory_id" value="{{ $inventory->id }}" required>

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

                            <div class="col-lg-6">
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

                            <div class="col-lg-6">
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

                        <a class="btn btn-warning" href="{{ route('inventories.index') }}">
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
                    @forelse ($inventory_details as $log)
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
                                    dot color="{{ $log->status === \App\Enums\InventoryDetailStatus::KEMBALI ? 'green' : 'orange' }}"
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
