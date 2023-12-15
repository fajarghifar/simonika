@extends('layouts.auth')

@section('content')
<div class="empty">
    <div class="empty-header">500</div>
    <p class="empty-title">Oops… Terjadi Kesalahan Internal Server</p>
    <p class="empty-subtitle text-muted">
        Maaf, terdapat masalah teknis di server. Silakan coba lagi nanti.
    </p>
    <div class="empty-action">
        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
    </div>
</div>
@endsection
