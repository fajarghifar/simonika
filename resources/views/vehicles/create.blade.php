@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <form class="row" action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-lg-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            {{ __('Foto') }}
                        </h3>

                        <img class="img-fluid rounded mx-auto d-block mb-2" style="max-width: 250px" src="{{ asset('static/product.webp') }}" alt="" id="image-preview" />

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

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Tambah Kendaraan') }}
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
                                        <option value="{{ $brand->id }}" @if(old('brand_id') == $brand->id) selected="selected" @endif>
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
                                        <option value="{{ $category->value }}" @if(old('category') == $category->value) selected="selected" @endif>{{ $category->label() }}</option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-md-12">
                                <x-input name="model"
                                        label="Model"
                                        placeholder="Model"
                                        value="{{ old('model') }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="year"
                                        label="Tahun Pembuatan"
                                        placeholder="Tahun pembuatan"
                                        value="{{ old('year') }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="license_plate"
                                        label="Nomor Polisi"
                                        placeholder="Nomor polisi"
                                        value="{{ old('license_plate') }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="stnk_number"
                                        label="Nomor STNK"
                                        placeholder="Nomor STNK"
                                        value="{{ old('stnk_number') }}"
                                        required="true"
                                />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="bpkb_number"
                                        label="Nomor BPKB"
                                        placeholder="Nomor BPKB"
                                        value="{{ old('bpkb_number') }}"
                                        required="true"
                                />
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <x-input name="chassis_number"
                                        label="Nomor Rangka"
                                        placeholder="Nomor rangka"
                                        value="{{ old('chassis_number') }}"
                                        required="true"
                                />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="engine_number"
                                        label="Nomor Mesin"
                                        placeholder="Nomor mesin"
                                        value="{{ old('engine_number') }}"
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
                                        value="{{ old('stnk_period') }}"
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
                                        value="{{ old('tax_period') }}"
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
                                        <option value="{{ $office->id }}" @if(old('office_id') == $office->id) selected="selected" @endif>
                                            {{ $office->code }} - {{ $office->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit">
                            {{ __('Simpan') }}
                        </x-button.save>

                        <a class="btn btn-warning" href="{{ url()->previous() }}">
                            {{ __('Batal') }}
                        </a>
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
