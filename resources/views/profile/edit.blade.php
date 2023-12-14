@extends('layouts.dashboard')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">

        <x-alert/>

        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Pengaturan Akun</h2>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                    <div class="card-body">
                        <h4 class="subheader">Pengaturan</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center active">Akun Saya</a>
                            <a href="{{ route('profile.edit.password') }}" class="list-group-item list-group-item-action d-flex align-items-center">Ganti Password</a>
                        </div>
                    </div>
                </div>

                <div class="col d-flex flex-column">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">

                            <h2 class="mb-4">Akun Saya</h2>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Profile picture image -->
                                    <img class="avatar avatar-lg rounded" src="{{ $user->photo ? asset('images/profile/'.$user->photo) : Avatar::create(Auth::user()->name)->toBase64() }}" id="image-preview" />
                                    <!-- Profile picture help block -->
                                    <div class="small font-italic text-muted my-2">JPG or PNG no larger than 1 MB</div>
                                    <!-- Profile picture input -->
                                    <input class="form-control form-control-solid mb-2 @error('photo') is-invalid @enderror" type="file" id="image" name="photo" accept="image/*" onchange="previewImage();">
                                    @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <h3 class="card-title mt-4">Detail</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        label="{{ __('Nama Lengkap') }}"
                                        id="name"
                                        name="name"
                                        :value="old('name', $user->name)"
                                        required="true"
                                    />
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <x-input.select name="gender"
                                                    label="Jenis Kelamin"
                                                    placeholder="{{ __('Pilih jenis kelamin:') }}"
                                    >
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->value }}" @if(old('gender', $user->gender->value) == $gender->value) selected="selected" @endif>{{ $gender->label() }}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        label="{{ __('Email') }}"
                                        id="email"
                                        name="email"
                                        :value="old('email', $user->email)"
                                        required="true"
                                    />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        label="{{ __('Telepon') }}"
                                        id="phone"
                                        name="phone"
                                        :value="old('phone', $user->phone)"
                                        required="true"
                                    />
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        label="{{ __('Nomor Induk Kependudukan (NIK)') }}"
                                        id="nik"
                                        name="nik"
                                        :value="old('nik', $user->nik)"
                                        required="true"
                                    />
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        label="{{ __('Nomor Induk Pegawai (NIP)') }}"
                                        id="nip"
                                        name="nip"
                                        :value="old('nip', $user->nip)"
                                        required="true"
                                    />
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        label="{{ __('Tempat Lahir') }}"
                                        id="place_of_birth"
                                        name="place_of_birth"
                                        :value="old('place_of_birth', $user->place_of_birth)"
                                        required="true"
                                    />
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">
                                            {{ __('Tanggal Lahir') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input name="date_of_birth" id="date_of_birth" type="date"
                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                            value="{{ old('date_of_birth', $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : now()->format('Y-m-d')) }}"
                                            required
                                        >

                                        @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <x-input.textarea
                                        label="{{ __('Alamat') }}"
                                        id="address"
                                        name="address"
                                        :value="old('address', $user->address)"
                                        required="true"
                                    />
                                </div>
                            </div>

                            <h3 class="card-title mt-4">Ganti Password</h3>
                            <div class="mb-3">
                                <a href="{{ route('profile.edit.password') }}" class="btn">
                                    Atur password baru
                                </a>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button type="submit">
                                {{ __('Update') }}
                            </x-button>
                            <x-button class="btn btn-warning" route="{{ route('profile.index') }}">
                                {{ __('Kembali') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
    <script src="{{ asset('dist/js/img-preview.js') }}"></script>
@endpush
