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

            <div class="col-12">
                <div class="row row-cards">

                    <div class="col-sm-6 col-lg-3">
                        <a class="card card-sm" href="{{ route('my.vehicles') }}">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-info text-white avatar">
                                            <i class="fa-solid fa-car-side"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                        {{ $userVehiclesCount }} Kepemilikan Kendaraan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <a class="card card-sm" href="{{ route('my.inventories') }}" >
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <i class="fa-solid fa-box"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                        {{ $userInventoriesCount }} Kepemilikan Inventaris
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <div class="card card-md">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <i class="fa-solid fa-ghost"></i>
                        </div>
                    </div>
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
