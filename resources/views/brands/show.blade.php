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

            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('brands.edit', $brand) }}" class="btn btn-warning d-none d-sm-inline-block">
                        <x-icon.pencil/>
                        {{ __('Edit') }}
                    </a>
                </div>
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
                        <a class="btn btn-info" href="{{ route('brands.index') }}">
                            <x-icon.chevron-left/>
                            {{ __('Back') }}
                        </a>
                        <a class="btn btn-warning" href="{{ route('brands.edit', $brand) }}">
                            <x-icon.pencil/>
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
