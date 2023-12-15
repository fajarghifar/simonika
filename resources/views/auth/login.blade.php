@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <a href="#" class="navbar-brand navbar-brand-autodark">
        <img src="{{ asset('static/logo-bjc-y.png') }}" width="150" alt="">
    </a>
</div>

<div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4">Masuk ke dalam Akun</h2>

        <!-- BEGIN: Login Form -->
        <form action="{{ route('login') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <!-- BEGIN : Input Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control @if($errors->get('email') OR $errors->get('password')) is-invalid @endif"
                    name="email"
                    placeholder="contoh@email.com"
                    autocomplete="off"
                />

                @if ($errors->get('email') OR $errors->get('username'))
                    <div class="invalid-feedback">
                        email atau password salah.
                    </div>
                @endif
            </div>
            <!-- END : Input Email -->

            <!-- BEGIN : Input Password -->
            <div class="mb-2">
                <label class="form-label">
                    Password
                </label>
                <div class="input-group input-group-flat">
                    <input
                        type="password"
                        class="form-control toggle-input @if($errors->get('email') OR $errors->get('password')) is-invalid @endif"
                        name="password"
                        placeholder="password"
                        autocomplete="off">
                    <span class="input-group-text">
                        <span class="link-secondary" title="Tampilkan password" data-bs-toggle="tooltip">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon toggle-password" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                        </span>
                    </span>

                    @if ($errors->get('email') OR $errors->get('username'))
                        <div class="invalid-feedback">
                            email atau password salah.
                        </div>
                    @endif
                </div>
            </div>
            <!-- END : Input Password -->

            <!-- BEGIN : Input Remember Me -->
            <div class="mb-2">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input"/>
                    <span class="form-check-label">Biarkan tetap masuk!</span>
                </label>
            </div>
            <!-- END : Input Remember Me -->

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
        <!-- END: Login Form -->
    </div>
</div>

{{-- <div class="text-center text-muted mt-3">
    Belum memiliki akun? <a href="{{ route('register') }}" tabindex="-1">Registrasi</a>
</div> --}}
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
