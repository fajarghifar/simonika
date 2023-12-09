@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Data Kendaraan') }}
                    </h3>
                </div>

                <div class="card-actions btn-group">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <x-icon.vertical-dots/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a href="{{ route('vehicles.create') }}" class="dropdown-item">
                                <x-icon.plus/>
                                {{ __('Tambah Kendaraan') }}
                            </a>
                            <a href="{{ route('vehicles.import.view') }}" class="dropdown-item">
                                <x-icon.plus/>
                                {{ __('Import Kendaraan') }}
                            </a>
                            <a href="{{ route('vehicles.export') }}" class="dropdown-item">
                                <x-icon.plus/>
                                {{ __('Export Kendaraan') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <form action="{{ route('vehicles.index') }}" method="GET">
                    <div class="d-flex">
                        <div class="text-secondary">
                            Tampilkan
                            <div class="mx-2 d-inline-block">
                                <select class="form-select form-select-sm" aria-label="result per page" name="row">
                                    <option value="10" {{ request('row') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ request('row') == '15' ? 'selected' : '' }}>15</option>
                                    <option value="25" {{ request('row') == '25' ? 'selected' : '' }}>25</option>
                                </select>
                            </div>
                            baris
                        </div>
                        <div class="ms-auto text-secondary">
                            Cari:
                            <div class="ms-2 d-inline-block input-icon">
                                <input type="text"class="form-control form-control-sm" aria-label="Search…" placeholder="Search…" name="search" value="{{ request('search') }}">
                                <span class="input-icon-addon">
                                    <x-icon.search/>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center w-1">
                                {{ __('No') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Nomor STNK') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Nomor Polisi') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Model') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Kategori') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Kantor') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td class="align-middle text-center">
                                {{ ($vehicles->currentPage() - 1) * $vehicles->perPage() + $loop->iteration }}
                            </td>

                            <td class="align-middle text-center">
                                {{ $vehicle->stnk_number }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $vehicle->license_plate }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->brand->name }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->model }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $vehicle->category->label() }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->office->code }} - {{ $vehicle->office->name }}
                            </td>
                            <td class="align-middle text-center">
                                <x-status
                                    dot color="{{ $vehicle->status === \App\Enums\VehicleStatus::TERSEDIA ? 'green' : 'orange' }}"
                                    class="text-uppercase"
                                >
                                    {{ $vehicle->status->label() }}
                                </x-status>
                            </td>
                            <td class="align-middle text-center" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('vehicles.show', $vehicle) }}"/>
                                <x-button.edit class="btn-icon" route="{{ route('vehicles.edit', $vehicle) }}"/>
                                <x-button.delete class="btn-icon" route="{{ route('vehicles.destroy', $vehicle) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="9">
                                <x-empty
                                    route="{{ route('vehicles.create') }}"
                                    title="{{ __('Kendaraan tidak ditemukan!') }}"
                                    message="{{ __('Coba sesuaikan pencarian atau filter Anda untuk menemukan apa yang sedang Anda cari.') }}"
                                    buttonLabel="{{ __('Tambahkan kendaraan terlebih dahulu!') }}"
                                    buttonRoute="{{ route('vehicles.create') }}"
                                />
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $vehicles->firstItem() }}</span>
                    to <span>{{ $vehicles->lastItem() }}</span> of <span>{{ $vehicles->total() }}</span> entries
                </p>

                <ul class="pagination m-0 ms-auto">
                    {{ $vehicles->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
