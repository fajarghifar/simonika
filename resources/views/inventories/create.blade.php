@extends('layouts.dashboard')

@push('page-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}" />
@endpush

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <form action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
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
                                    {{ __('Tambah Inventaris') }}
                                </h3>
                            </div>

                            <div class="card-actions">
                                <x-action.close route="{{ route('inventories.index') }}" />
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
                                    <x-input name="serial_number"
                                            label="Nomor Seri"
                                            placeholder="Nomor seri"
                                            value="{{ old('serial_number') }}"
                                            required="true"
                                    />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="purchased_date" class="form-label">
                                            {{ __('Tanggal Pembelian') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input name="purchased_date" id="purchased_date" type="date"
                                            class="form-control @error('purchased_date') is-invalid @enderror"
                                            value="{{ old('purchased_date') ?? now()->format('Y-m-d') }}"
                                            required
                                        >

                                        @error('purchased_date')
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

                            <x-button class="btn btn-warning" route="{{ route('inventories.index') }}">
                                {{ __('Kembali') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('dist/js/img-preview.js') }}"></script>

    <script>
        $( '#brand_id, #office_id, #category' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
@endpush
