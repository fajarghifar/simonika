@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <a href="#" class="navbar-brand navbar-brand-autodark">
        <img src="{{ asset('static/logo.svg') }}" height="36" alt="">
    </a>
</div>

<form class="card card-md" action="{{ route('register') }}" method="POST" autocomplete="off" novalidate>
    @csrf
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Membuat akun baru</h2>

        <!-- BEGIN : Input Name -->
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                placeholder="Masukan nama"
            />

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!-- END : Input Name -->


        <!-- BEGIN : Input Email -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                placeholder="Masukan email"
            />
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!-- END : Input Email -->


        <!-- BEGIN : Input Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group input-group-flat">
                <input
                    type="password"
                    class="form-control toggle-input @error('password') is-invalid @enderror""
                    name="password"
                    placeholder="Password"
                    autocomplete="off">
                <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon toggle-password" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </a>
                </span>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <!-- END : Input Password -->

        <!-- BEGIN : Input Confirm Password -->
        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <div class="input-group input-group-flat">
                <input
                    type="password"
                    class="form-control toggle-input @error('password_confirmation') is-invalid @enderror""
                    name="password_confirmation"
                    placeholder="Password"
                    autocomplete="off">
                <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon toggle-password" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </a>
                </span>
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <!-- END : Input Confirm Password -->

        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Registrasi</button>
        </div>
    </div>
</form>

<div class="text-center text-muted mt-3">
    Sudah memiliki akun? <a href="{{ route('login') }}" tabindex="-1">Login</a>
</div>
@endsection

@push('page-scripts')
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                $(this).toggleClass("text-primary");
                var input = $($(this).closest(".input-group").find(".toggle-input"));

                input.attr("type", input.attr("type") === "password" ? "text" : "password");
            });
        });
    </script>
@endpush
