@extends('layouts.dashboard')

@push('page-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}" />
@endpush

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Tambah Pengguna') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                                    {{ __('Detail Pengguna') }}
                                </h3>
                            </div>

                            <div class="card-actions">
                                <x-action.close route="{{ route('users.index') }}" />
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-6">
                                    <x-input name="name"
                                            label="Nama"
                                            placeholder="Nama lengkap"
                                            value="{{ old('name') }}"
                                            required="true"
                                    />
                                </div>

                                <div class="col-lg-6">
                                    <x-input.select name="gender"
                                                    label="Jenis Kelamin"
                                                    placeholder="{{ __('Pilih:') }}"
                                    >
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->value }}" @if(old('gender') == $gender->value) selected="selected" @endif>
                                                {{ $gender->label() }}
                                            </option>
                                        @endforeach
                                    </x-input.select>
                                </div>

                                <div class="col-lg-6">
                                    <x-input name="nip"
                                            label="Nomor Induk Pegawai (NIP)"
                                            placeholder="Nomor Induk Pegawai"
                                            value="{{ old('nip') }}"
                                            required="true"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <x-input name="nik"
                                            label="Nomor Induk Kependudukan (NIK)"
                                            placeholder="Nomor Induk Kependudukan"
                                            value="{{ old('nik') }}"
                                            required="true"
                                    />
                                </div>

                                <div class="col-lg-6">
                                    <x-input name="place_of_birth"
                                            label="Tempat Lahir"
                                            placeholder="Tempat Lahir"
                                            value="{{ old('place_of_birth') }}"
                                            required="true"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">
                                            {{ __('Tanggal Lahir') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input name="date_of_birth" id="date_of_birth" type="date"
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            value="{{ old('date_of_birth') }}"
                                            required
                                        >

                                        @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <x-input name="email"
                                            label="Email"
                                            placeholder="contoh@email.com"
                                            value="{{ old('email') }}"
                                            required="true"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <x-input name="phone"
                                            label="Nomor Telepon"
                                            placeholder="(+62)"
                                            value="{{ old('phone') }}"
                                            required="true"
                                    />
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">
                                            {{ __('Alamat') }}
                                        </label>

                                        <textarea name="address"
                                                id="address"
                                                rows="3"
                                                class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Alamat"
                                        >{{ old('address') }}</textarea>

                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <x-input
                                        type="password"
                                        name="password"
                                        label="Password"
                                        required
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <x-input
                                        type="password"
                                        name="password_confirmation"
                                        label="Konfirmasi Password"
                                        required
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-input.select name="role_id"
                                        label="Role"
                                        placeholder="{{ __('Pilih:') }}"
                                    >
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if(old('role_id') == $role->id) selected="selected" @endif>{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button.save type="submit">
                                {{ __('Simpan') }}
                            </x-button.save>
                            <x-button class="btn btn-warning" route="{{ route('users.index') }}">
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
        let classList = '#gender, #role_id';
        $( classList ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
@endpush
