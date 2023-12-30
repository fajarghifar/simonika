@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ $user->name }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <x-alert/>

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
                                    src="{{ $user->photo ? asset('images/profile/'.$user->photo) : Avatar::create($user->name)->toBase64() }}"
                                    id="image-preview"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Lainnya') }}
                                </h3>
                                <div class="medium font-italic text-muted mb-2">
                                    Tampilkan riwayat peminjaman yang dilakukan oleh pengguna ini.
                                </div>
                                <div class="row">
                                    <div class="col-6 py-3">
                                        <a class="btn btn-outline-info w-100" href="{{ route('users.inventories', $user) }}">
                                            <i class="fa-solid fa-box me-2"></i>
                                            {{ __('Inventaris') }}
                                        </a>
                                    </div>
                                    <div class="col-6 py-3">
                                        <a class="btn btn-outline-info w-100" href="{{ route('users.vehicles', $user) }}">
                                            <i class="fa-solid fa-car-side me-2"></i>
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
                                {{ __('Detail Pengguna') }}
                            </h3>
                        </div>

                        <div class="card-actions">
                            <x-action.close route="{{ route('users.index') }}" />
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Nama</label>
                                    <p class="form-control form-control-solid ">{{ $user->name }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Jenis Kelamin</label>
                                    <p class="form-control form-control-solid ">{{ $user->gender->label() }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Nomor Induk Pegawai (NIP)</label>
                                    <p class="form-control form-control-solid ">{{ $user->nip }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Nomor Induk Kependudukan (NIK)</label>
                                    <p class="form-control form-control-solid ">{{ $user->nik }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Tempat Lahir</label>
                                    <p class="form-control form-control-solid ">{{ $user->place_of_birth }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Tanggal Lahir</label>
                                    <p class="form-control form-control-solid ">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Email</label>
                                    <p class="form-control form-control-solid ">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Nomor Telepon</label>
                                    <p class="form-control form-control-solid ">{{ $user->phone }}</p>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Alamat</label>
                                    <textarea class="form-control" rows="3">{{ $user->address }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Role</label>
                                    <p class="btn position-relative btn-{{ $user->role->id === 1 ? 'green' : 'orange' }} w-10">
                                        {{ ucfirst($user->role->name) }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button class="btn btn-info" route="{{ route('users.edit', $user) }}">
                            {{ __('Edit') }}
                        </x-button>
                        <x-button class="btn btn-warning" route="{{ route('users.index') }}">
                            {{ __('Kembali') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
