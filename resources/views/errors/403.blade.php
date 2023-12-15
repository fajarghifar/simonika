@extends('layouts.auth')

@section('content')
<div class="empty">
    <div class="empty-header">403</div>
    <p class="empty-title">Oops… Akses Ditolak</p>
    <p class="empty-subtitle text-muted">
        Maaf, Anda tidak diizinkan untuk mengakses halaman ini.
    </p>
    <div class="empty-action">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
</div>
@endsection
