@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ $brand->name }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('Detail Brand') }}
                        </h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                            <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $brand->name }}</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>{{ $brand->category->label() }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-end">
                        <x-button class="btn btn-info" route="{{ route('brands.edit', $brand) }}">
                            {{ __('Edit') }}
                        </x-button>
                        <x-button class="btn btn-warning" route="{{ route('brands.index') }}">
                            {{ __('Kembali') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
