@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Foto') }}
                                    </h3>

                                    <img
                                        class="img-fluid rounded mx-auto d-block mb-2" style="max-width: 250px"
                                        src="{{ Auth::user()->photo ? asset('images/profile/'.Auth::user()->photo) : Avatar::create(Auth::user()->name)->toBase64() }}"
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
                                        {{ __('Lainnya') }}
                                    </h3>
                                    <div class="row">
                                        <div class="col-6 py-3">
                                            <a class="btn btn-outline-info w-100" href="{{ route('users.inventories', $user) }}">
                                                <x-icon.box/>
                                                {{ __('Inventaris') }}
                                            </a>
                                        </div>
                                        <div class="col-6 py-3">
                                            <a class="btn btn-outline-info w-100" href="{{ route('users.vehicles', $user) }}">
                                                <x-icon.car/>
                                                {{ __('Kendaraan') }}
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
                                    {{ __('Edit Pengguna') }}
                                </h3>
                            </div>

                            <div class="card-actions">
                                <x-action.close route="{{ route('users.index') }}" />
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <x-input name="name"
                                            label="Nama"
                                            placeholder="Nama lengkap"
                                            value="{{ old('name', $user->name) }}"
                                            required="true"
                                    />
                                </div>

                                <div class="col-sm-6 col-md-6">
                                    <x-input.select name="gender"
                                                    label="Jenis Kelamin"
                                                    placeholder="{{ __('Pilih:') }}"
                                    >
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->value }}" @if(old('gender', $user->gender->value) == $gender->value) selected="selected" @endif>{{ $gender->label() }}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>

                                <div class="col-md-6">
                                    <x-input name="nip"
                                            label="Nomor Induk Pegawai (NIP)"
                                            placeholder="Nomor Induk Pegawai"
                                            value="{{ old('nip', $user->nip) }}"
                                            required="true"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <x-input name="nik"
                                            label="Nomor Induk Kependudukan (NIK)"
                                            placeholder="Nomor Induk Kependudukan"
                                            value="{{ old('nik', $user->nik) }}"
                                            required="true"
                                    />
                                </div>

                                <div class="col-md-6">
                                    <x-input name="place_of_birth"
                                            label="Tempat Lahir"
                                            placeholder="Tempat Lahir"
                                            value="{{ old('place_of_birth', $user->place_of_birth) }}"
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

                                <div class="col-md-6">
                                    <x-input name="email"
                                            label="Email"
                                            placeholder="contoh@email.com"
                                            value="{{ old('email', $user->email) }}"
                                            required="true"
                                    />
                                </div>
                                <div class="col-md-6">
                                    <x-input name="phone"
                                            label="Nomor Telepon"
                                            placeholder="(+62)"
                                            value="{{ old('phone', $user->phone) }}"
                                            required="true"
                                    />
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

                                <div class="col-md-6">
                                    <x-input.select name="role_id"
                                                    label="Role"
                                                    placeholder="{{ __('Pilih:') }}"
                                    >
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->value }}" @if(old('role_id', $user->role_id->value) == $role->value) selected="selected" @endif>{{ $role->label() }}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button.save type="submit">
                                {{ __('Update') }}
                            </x-button.save>

                            <a class="btn btn-warning" href="{{ url()->previous() }}">
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
