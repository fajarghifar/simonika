@extends('layouts.auth')

@section('content')
<div class="empty">
    <div class="empty-header">404</div>
    <p class="empty-title">Oops… Anda baru saja menemukan halaman error</p>
    <p class="empty-subtitle text-muted">
        Maaf, tetapi halaman yang Anda cari tidak ditemukan
    </p>
    <div class="empty-action">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
</div>
@endsection
