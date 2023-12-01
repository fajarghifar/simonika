@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <form action="{{ route('offices.update', $office->id) }}" method="POST">
                @csrf
                @method('put')
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
                    <x-input
                        label="{{ __('Kode') }}"
                        id="code"
                        name="code"
                        :value="old('code', $office->code)"
                    />

                    <x-input
                        label="{{ __('Nama') }}"
                        id="name"
                        name="name"
                        :value="old('name', $office->name)"
                    />

                    <x-input.textarea
                        label="{{ __('Alamat') }}"
                        id="address"
                        name="address"
                        :value="old('address', $office->address)"
                    />
                </div>

                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Update') }}
                    </x-button>
                    <x-button class="btn btn-warning" route="{{ url()->previous() }}">
                        {{ __('Batal') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
