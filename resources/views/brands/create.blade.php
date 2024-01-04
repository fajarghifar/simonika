@extends('layouts.dashboard')

@push('page-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dist/css/select2-bootstrap-5-theme.min.css') }}" />
@endpush

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Tambah Brand') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <form action="{{ route('brands.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Detail Brand') }}
                        </h3>
                    </div>

                    <div class="card-actions">
                        <x-action.close route="{{ route('brands.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <x-input label="Nama"
                                name="name"
                                id="name"
                                placeholder="Nama Brand"
                                value="{{ old('name') }}"
                    />

                    <div class="mb-3">
                        <x-input.select name="category"
                                        label="Kategori"
                                        placeholder="{{ __('Pilih:') }}"
                        >
                            @foreach ($categories as $category)
                                <option value="{{ $category->value }}">{{ $category->label() }}</option>
                            @endforeach
                        </x-input.select>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <x-button.save type="submit">
                        {{ __('Simpan') }}
                    </x-button.save>
                    <x-button class="btn btn-warning" route="{{ route('brands.index') }}">
                        {{ __('Kembali') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        let classList = '#category';
        $( classList ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' )
        } );
    </script>
@endpush
