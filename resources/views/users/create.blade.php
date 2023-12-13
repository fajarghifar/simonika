@extends('layouts.dashboard')

@section('content')
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
                                    {{ __('Tambah Pengguna') }}
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

                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button.save type="submit">
                                {{ __('Simpan') }}
                            </x-button.save>

                            <a class="btn btn-warning" href="{{ route('users.index') }}">
                                {{ __('Batal') }}
                            </a>
                        </div>
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
