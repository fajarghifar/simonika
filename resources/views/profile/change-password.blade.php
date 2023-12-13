@extends('layouts.dashboard')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">

        <x-alert/>

        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Pengaturan Akun</h2>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col-3 d-none d-md-block border-end">
                    <div class="card-body">
                        <h4 class="subheader">Pengaturan</h4>
                        <div class="list-group list-group-transparent">
                            <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action d-flex align-items-center">Akun Saya</a>
                            <a href="{{ route('profile.edit.password') }}" class="list-group-item list-group-item-action d-flex align-items-center active">Ganti Password</a>
                        </div>
                    </div>
                </div>

                <div class="col d-flex flex-column">
                    <x-form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <h3 class="card-title mt-4">Ganti Password</h3>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <x-input
                                        type="password"
                                        name="current_password"
                                        label="Password"
                                        required
                                    />
                                    <x-input
                                        type="password"
                                        name="password"
                                        label="Password Baru"
                                        required
                                    />
                                    <x-input
                                        type="password"
                                        name="password_confirmation"
                                        label="Konfirmasi Password Baru"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <x-button type="submit">
                                {{ __('Perbarui') }}
                            </x-button>
                            <x-button class="btn btn-warning" route="{{ route('profile.index') }}">
                                {{ __('Batal') }}
                            </x-button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
    <script src="{{ asset('dist/js/img-preview.js') }}"></script>
@endpush
