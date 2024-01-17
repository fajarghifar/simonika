@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ \Carbon\Carbon::parse($extension->created_at)->format('d/m/Y') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Detail Pengajuan') }}</h3>

                    <div class="card-actions">
                        <x-action.close route="{{ route('vehicles.extensions.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Tanggal Pengajuan') }}</div>
                                <div class="datagrid-content">{{ \Carbon\Carbon::parse($extension->created_at)->format('d/m/Y') }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Diajukan oleh') }}</div>
                                <div class="datagrid-content">{{ $extension->requestedBy->name }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Disetujui oleh') }}</div>
                                <div class="datagrid-content">{{ $extension->approved_by ? $extension->approvedBy->name : '-' }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Status') }}</div>
                                <div class="datagrid-content">
                                    <x-status
                                        dot color="{{ $extension->status === \App\Enums\VehicleExtensionStatus::APPROVED ? 'green' : 'orange' }}"
                                        class="text-uppercase"
                                    >
                                        {{ $extension->status->label() }}
                                    </x-status>
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Nomor STNK') }}</div>
                                <div class="datagrid-content">{{ $extension->vehicle->stnk_number }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Kategori') }}</div>
                                <div class="datagrid-content">{{ $extension->vehicle->category->label() }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Brand') }}</div>
                                <div class="datagrid-content">{{ $extension->vehicle->brand->name }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Model') }}</div>
                                <div class="datagrid-content">{{ $extension->vehicle->model }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Periode STNK (Terbaru)') }}</div>
                                <div class="datagrid-content">{{ \Carbon\Carbon::parse($extension->stnk_period)->format('d/m/Y') }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Periode Pajak (Terbaru)') }}</div>
                                <div class="datagrid-content">{{ \Carbon\Carbon::parse($extension->tax_period)->format('d/m/Y') }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Dokumen Pendukung') }}</div>
                                <div class="datagrid-content">
                                    <x-button class="btn btn-sm btn-info" route="{{ asset('documents/'.$extension->document) }}">
                                        {{ __('Download') }}
                                    </x-button>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">{{ __('Detail Kendaraan') }}</div>
                                <div class="datagrid-content">
                                    <x-button class="btn btn-sm btn-info" route="{{ route('vehicles.show', $extension->vehicle) }}">
                                        {{ __('Lihat') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    @if (!$extension->approved_by)
                        <form action="{{ route('vehicles.extensions.update', $extension) }}" method="POST">
                            @csrf
                            @method('put')
                            <x-button.save class="btn btn-success" onclick="return confirm('Apakah Anda yakin untuk menyetujui pengajuan ini?')">
                                {{ __('Terima') }}
                            </x-button.save>
                            <x-button class="btn btn-warning" route="{{ url()->previous() }}">
                                {{ __('Kembali') }}
                            </x-button>
                        </form>
                    @else
                        <x-button class="btn btn-warning" route="{{ url()->previous() }}">
                            {{ __('Kembali') }}
                        </x-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
