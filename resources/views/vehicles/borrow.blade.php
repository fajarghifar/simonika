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
                    {{ $vehicle->model }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        @if ($vehicle_detail_current && $vehicle_detail_current->status == \App\Enums\VehicleDetailStatus::PINJAM)
        <form class="row" action="{{ route('vehicles.return', $vehicle_detail_current) }}" method="POST">
            @csrf
            @method('put')

            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Peminjaman') }}
                            </h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 col-md-6">
                                <x-input.select name="user_id"
                                                label="Nama Pengguna"
                                                placeholder="{{ __('Pilih:') }}"
                                                readonly
                                >
                                    <option selected>
                                        {{ $vehicle_detail_current->user->name }}
                                    </option>
                                </x-input.select>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input name="borrowed_date"
                                            label="Tanggal Pinjam"
                                            value="{{ $vehicle_detail_current->borrowed_date }}"
                                            readonly="true"
                                />
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <x-button.save type="submit" onclick="return confirm('Apakah Anda yakin untuk mengembalikan?')">
                            {{ __('Kembalikan') }}
                        </x-button.save>
                    </div>
                </div>
            </div>
        </form>
        @else
        <form action="{{ route('vehicles.borrow.store', $vehicle) }}" class="row" method="POST">
            @csrf

            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Peminjaman') }}
                            </h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row row-cards">

                            <div class="col-sm-6 col-md-6">
                                <x-input.select name="user_id"
                                                label="Nama Pengguna"
                                                placeholder="{{ __('Pilih:') }}"
                                >
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </x-input.select>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('Tanggal Pinjam') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input name="borrowed_date" type="date"
                                        class="form-control @error('borrowed_date') is-invalid @enderror"
                                        value="{{ old('borrowed_date') }}"
                                        required
                                    >

                                    @error('borrowed_date')
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
                    </div>
                </div>
            </div>
        </form>
        @endif

    </div>
</div>
@endsection

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        let classList = '#user_id';
        $( classList ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
@endpush
