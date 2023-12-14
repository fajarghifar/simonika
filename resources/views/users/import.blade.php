@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <form action="{{ route('users.import.handler') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Import Pengguna') }}
                        </h3>
                    </div>

                    <div class="card-actions">
                        <x-action.close route="{{ route('users.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <input type="file"
                            id="file"
                            name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                    >

                    @error('file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Import') }}
                    </x-button>
                    <x-button class="btn btn-warning" route="{{ route('users.index') }}">
                        {{ __('Kembali') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
