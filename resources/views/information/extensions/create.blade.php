@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Detail Pengajuan') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card">
            <form action="{{ route('information.extensions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Detail Pengajuan') }}
                        </h3>
                    </div>

                    <div class="card-actions">
                        <x-action.close route="{{ route('brands.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="document"
                                        class="form-label @error('document') text-danger @enderror required"
                                >
                                    {{ __('Dokumen Pendukung') }}
                                </label>

                                <input
                                    type="file"
                                    accept="file/*"
                                    id="document"
                                    name="document"
                                    class="form-control @error('document') is-invalid @enderror"
                                >

                                @error('document')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <x-input.select name="vehicle_id"
                                            label="Kendaraan"
                                            placeholder="{{ __('Pilih:') }}"
                            >
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" @if(old('vehicle_id') == $vehicle->id) selected="selected" @endif>
                                        {{ $vehicle->stnk_number }} - {{ $vehicle->model }}
                                    </option>
                                @endforeach
                            </x-input.select>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Periode Pajak') }}
                                </label>

                                <input name="tax_period" type="date"
                                    class="form-control @error('tax_period') is-invalid @enderror"
                                    value="{{ old('tax_period') }} required"
                                >

                                @error('tax_period')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ __('Periode STNK') }}
                                </label>

                                <input name="stnk_period" type="date"
                                    class="form-control @error('stnk_period') is-invalid @enderror"
                                    value="{{ old('stnk_period') }} required"
                                >

                                @error('stnk_period')
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
                        {{ __('Kirim') }}
                    </x-button.save>
                    <x-button class="btn btn-warning" route="{{ url()->previous() }}">
                        {{ __('Kembali') }}
                    </x-button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
