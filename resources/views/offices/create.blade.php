@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Tambah Kantor') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <form action="{{ route('offices.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Detail Kantor') }}
                        </h3>
                    </div>

                    <div class="card-actions">
                        <x-action.close route="{{ route('offices.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <x-input label="Kode"
                                name="code"
                                id="code"
                                placeholder="Kode Kantor"
                                value="{{ old('code') }}"
                    />

                    <x-input label="Nama"
                                name="name"
                                id="name"
                                placeholder="Nama Kantor"
                                value="{{ old('name') }}"
                    />

                    <div class="mb-3">
                        <label for="address" class="form-label">
                            {{ __('Alamat') }}
                        </label>

                        <textarea name="address"
                                id="address"
                                rows="5"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Alamat Kantor"
                        >{{ old('address') }}</textarea>

                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-end">
                    <x-button.save type="submit">
                        {{ __('Simpan') }}
                    </x-button.save>
                    <x-button class="btn btn-warning" route="{{ route('offices.index') }}">
                        {{ __('Kembali') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
