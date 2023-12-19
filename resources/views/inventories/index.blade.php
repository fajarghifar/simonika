@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Data Inventaris') }}
                    </h3>
                </div>

                <div class="card-actions btn-group">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a href="{{ route('inventories.create') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Tambah Inventaris') }}
                            </a>
                            <a href="{{ route('inventories.import.view') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Import Inventaris') }}
                            </a>
                            <a href="{{ route('inventories.export') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Export Inventaris') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <form action="{{ route('inventories.index') }}" method="GET">
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
                            <th class="align-middle w-1">
                                {{ __('No') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Nomor Seri') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Merek') }}
                            </th>
                            <th scope="col" class="align-middle">
                                @sortablelink('model', 'Model')
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Kategori') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Kantor') }}
                            </th>
                            <th scope="col" class="align-middle">
                                @sortablelink('status', 'Status')
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($inventories as $inventory)
                        <tr>
                            <td class="align-middle">
                                {{ ($inventories->currentPage() - 1) * $inventories->perPage() + $loop->iteration }}
                            </td>

                            <td class="align-middle">
                                {{ $inventory->serial_number }}
                            </td>
                            <td class="align-middle">
                                {{ $inventory->brand->name }}
                            </td>
                            <td class="align-middle">
                                {{ $inventory->model }}
                            </td>
                            <td class="align-middle">
                                {{ $inventory->category->label() }}
                            </td>
                            <td class="align-middle">
                                {{ $inventory->office->code }} - {{ $inventory->office->name }}
                            </td>
                            <td class="align-middle">
                                <x-status
                                    dot color="{{ $inventory->status === \App\Enums\InventoryStatus::TERSEDIA ? 'green' : 'orange' }}"
                                    class="text-uppercase"
                                >
                                    {{ $inventory->status->label() }}
                                </x-status>
                            </td>
                            <td class="align-middle" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('inventories.show', $inventory) }}"/>
                                <x-button.edit class="btn-icon" route="{{ route('inventories.edit', $inventory) }}"/>
                                <x-button.delete class="btn-icon" route="{{ route('inventories.destroy', $inventory) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle" colspan="8">
                                <x-empty
                                    route="{{ route('inventories.create') }}"
                                    title="{{ __('Inventaris tidak ditemukan') }}"
                                    message="{{ __('Coba sesuaikan pencarian atau filter Anda untuk menemukan apa yang sedang Anda cari.') }}"
                                    buttonLabel="{{ __('Tambahkan inventaris terlebih dahulu!') }}"
                                    buttonRoute="{{ route('inventories.create') }}"
                                />
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $inventories->firstItem() }}</span>
                    to <span>{{ $inventories->lastItem() }}</span> of <span>{{ $inventories->total() }}</span> entries
                </p>

                <ul class="pagination m-0 ms-auto">
                    {{ $inventories->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
