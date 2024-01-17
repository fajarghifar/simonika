@extends('layouts.dashboard')

@section('content')
<!-- BEGIN : Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Halaman</div>
                <h2 class="page-title">Dashboard</h2>
            </div>
        </div>
    </div>
</div>
<!-- END : Page header -->

<!-- BEGIN : Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">

            @if (Auth::user()->role->name === 'admin')
            <div class="col-12">
                <div class="row row-cards">

                    <div class="col-sm-6 col-lg-3">
                        <a class="card card-sm" href="{{ route('vehicles.index') }}">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-info text-white avatar">
                                            <i class="fa-solid fa-car-side"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                        {{ $vehiclesCount }} Kendaraan
                                        </div>
                                        <div class="text-muted">
                                        {{ $borrowedVehiclesCount }} dipinjam
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <a class="card card-sm" href="{{ route('inventories.index') }}">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <i class="fa-solid fa-box"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                        {{ $inventoriesCount }} Inventaris
                                        </div>
                                        <div class="text-muted">
                                        {{ $borrowedInventoriesCount }} dipinjam
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <a class="card card-sm" href="{{ route('users.index') }}">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-twitter text-white avatar">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                        {{ $usersCount }} Pengguna
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
            @endif

            <div class="col-12">
                <div class="card card-md">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <i class="fa-solid fa-house"></i>
                        </div>
                    </div>
                    <div class="card-status-start bg-primary"></div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">Selamat datang di Aplikasi Monitoring Inventaris dan Kendaraan.</h3>
                                <div class="markdown text-secondary">
                                Aplikasi Monitoring Inventaris dan Pajak Kendaraan adalah solusi terintegrasi yang dirancang untuk membantu perusahaan atau instansi dalam efisiensi manajemen inventaris barand dan kendaraan, serta pemantauan kewajiban pajak terkait.
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
