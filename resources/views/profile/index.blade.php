@extends('layouts.dashboard')

@section('content')
<!-- BEGIN : Page header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="avatar avatar-lg rounded" style="background-image: url({{ $user->photo ? asset('images/profile/'.$user->photo) : Avatar::create(Auth::user()->name)->toBase64() }})"></span>
            </div>
            <div class="col">
                <h1 class="fw-bold">{{ $user->name }}</h1>
                <div class="list-inline list-inline-dots text-muted">
                    <div class="list-inline-item">
                        <i class="fa-solid fa-map me-2"></i>
                        {{ $user->address }}
                    </div>
                    <div class="list-inline-item">
                        <i class="fa-solid fa-envelope me-2"></i>
                        <a href="mailto:{{ $user->email }}" class="text-reset">{{ $user->email }}</a>
                    </div>
                    <div class="list-inline-item">
                        <i class="fa-solid fa-cake-candles me-2"></i>
                        {{ $user->date_of_birth }}
                    </div>
                </div>
            </div>
            <div class="col-auto ms-auto">
                <div class="dropdown btn btn-sm">
                    <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">{{ __('Edit Profile') }}</a>
                        <a href="{{ route('profile.edit.password') }}" class="dropdown-item">{{ __('Ganti Password') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END : Page header -->

<!-- BEGIN : Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row g-3">

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Riwayat Login
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123.123.123</td>
                                        <td class="text-secondary">12:12 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row row-cards">
                    <div class="col-12">
                        <!-- Account details card -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Detail Akun
                            </div>
                            <div class="card-body row">
                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Nama Lengkap</label>
                                    <p class="form-control form-control-solid ">{{ $user->name }}</p>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Jenis Kelamin</label>
                                    <p class="form-control form-control-solid ">{{ $user->gender->label() }}</p>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Email</label>
                                    <p class="form-control form-control-solid ">{{ $user->email }}</p>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Nomor Telepon</label>
                                    <p class="form-control form-control-solid ">{{ $user->phone }}</p>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Nomor Induk Kependudukan (NIK)</label>
                                    <p class="form-control form-control-solid ">{{ $user->nik }}</p>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Nomor Induk Pegawai (NIP)</label>
                                    <p class="form-control form-control-solid ">{{ $user->nip }}</p>
                                </div>

                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Tempat Lahir</label>
                                    <p class="form-control form-control-solid ">{{ $user->place_of_birth }}</p>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label class="small mb-1">Tanggal Lahir</label>
                                    <p class="form-control form-control-solid ">{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d M Y') }}</p>
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <label class="small mb-1">Alamat</label>
                                    <textarea class="form-control" rows="3" readonly>{{ $user->address }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END : Page body -->
@endsection
