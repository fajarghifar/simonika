@extends('layouts.dashboard')

@section('content')
<!-- BEGIN : Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Informasi</div>
                <h2 class="page-title">Kepemilikan Inventaris dan Kendaraan</h2>
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
                            <i class="fa-solid fa-hands-holding-circle"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">Selamat datang di halaman Kepemilikan Inventaris dan Kendaraan</h3>
                                <div class="markdown text-secondary">
                                    Di sini Anda akan menemukan ringkasan mengenai inventaris dan kendaraan yang dimiliki atau dipegang oleh Anda.
                                    <ul>
                                        <li>
                                            <strong>Inventaris:</strong> Informasi mengenai berbagai barang atau perlengkapan yang dimiliki, seperti perangkat elektronik, peralatan kantor, atau benda berharga lainnya.
                                        </li>
                                        <li>
                                            <strong>Kendaraan:</strong> Detail tentang kendaraan yang Anda miliki, seperti mobil, sepeda motor, atau alat transportasi lainnya.
                                        </li>
                                    </ul>
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
