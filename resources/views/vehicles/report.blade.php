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
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a href="{{ route('vehicles.create') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Tambah Kendaraan') }}
                            </a>
                            <x-form action="{{ route('vehicles.users.reminder') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit" onclick="return confirm('Apakah Anda yakin untuk mengirimkan pesan pengingat untuk semuanya?')">
                                    <i class="fa-solid fa-envelope me-1"></i>
                                    {{ __('Ingatkan Semua') }}
                                </button>
                            </x-form>
                            {{-- <a href="{{ route('vehicles.import.view') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Import Kendaraan') }}
                            </a>
                            <a href="{{ route('vehicles.export') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Export Kendaraan') }}
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <form action="{{ $search }}" method="GET">
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
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-vcenter card-table text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle w- 1">
                                {{ __('No') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Nomor Polisi') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="align-middle">
                                @sortablelink('model', 'Model')
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Kategori') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Pengguna') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Periode Pajak') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Periode STNK') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td class="align-middle">
                                {{ ($vehicles->currentPage() - 1) * $vehicles->perPage() + $loop->iteration }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->license_plate }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->brand->name }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->model }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->category->label() }}
                            </td>
                            <td class="align-middle">
                                {{ $vehicle->user ? $vehicle->user->name : '-' }}
                            </td>
                            <td class="align-middle">
                                <x-status
                                    color="{{ \Carbon\Carbon::parse($vehicle->tax_period)->isPast() ? 'orange' : 'green' }}"
                                    class="text-uppercase"
                                >
                                    {{ \Carbon\Carbon::parse($vehicle->tax_period)->format('d M Y') }}
                                </x-status>
                            </td>
                            <td class="align-middle">
                                <x-status
                                    color="{{ \Carbon\Carbon::parse($vehicle->stnk_period)->isPast() ? 'orange' : 'green' }}"
                                    class="text-uppercase"
                                >
                                    {{ \Carbon\Carbon::parse($vehicle->stnk_period)->format('d M Y') }}
                                </x-status>
                            </td>
                            <td class="w-4">
                                <div class="d-flex justify-content-end">
                                @if ($vehicle->user?->phone)
                                    <x-form action="{{ route('vehicles.user.reminder', $vehicle) }}" method="POST" class="me-1">
                                        @csrf
                                        <x-button type="submit" class="btn btn-icon btn-outline-success" onclick="return confirm('Apakah Anda yakin untuk mengirimkan pesan pengingat pada {{ $vehicle->user->name }}?')">
                                            <i class="fa-solid fa-envelope"></i>
                                        </x-button>
                                    </x-form>
                                @endif
                                    <x-button.show class="btn-icon me-1" route="{{ route('vehicles.show', $vehicle) }}" />
                                    <x-button.edit class="btn-icon me-1" route="{{ route('vehicles.edit', $vehicle) }}" />
                                    <x-button.delete class="btn-icon me-1" route="{{ route('vehicles.destroy', $vehicle) }}" />
                                </div>
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
