@extends('layouts.dashboard')

@section('content')
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
                                    src="{{ Auth::user()->photo ? asset('images/profile/'.Auth::user()->photo) : Avatar::create(Auth::user()->name)->toBase64() }}"
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

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a class="btn btn-warning" href="{{ route('users.index') }}">
                            <x-icon.chevron-left/>
                            {{ __('Kembali') }}
                        </a>
                        <a class="btn btn-info" href="{{ route('users.edit', $user) }}">
                            <x-icon.pencil/>
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
