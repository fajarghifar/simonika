@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <x-alert/>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Data Kantor') }}
                    </h3>
                </div>

                <div class="card-actions btn-group">
                    <div class="dropdown">
                        <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a href="{{ route('offices.create') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Tambah Kantor') }}
                            </a>
                            <a href="{{ route('offices.import.view') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Import Kantor') }}
                            </a>
                            <a href="{{ route('offices.export') }}" class="dropdown-item">
                                <i class="fa-solid fa-plus me-1"></i>
                                {{ __('Export Kantor') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-bottom py-3">
                <form action="{{ route('offices.index') }}" method="GET">
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
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center w-1">
                                {{ __('No') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                @sortablelink('code', 'Kode')
                            </th>
                            <th scope="col" class="align-middle text-center">
                                @sortablelink('name', 'Nama')
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Alamat') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($offices as $office)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="align-middle">
                                {{ $office->code }}
                            </td>
                            <td class="align-middle">
                                {{ $office->name }}
                            </td>
                            <td class="align-middle">
                                {{ $office->address }}
                            </td>
                            <td class="align-middle text-center" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('offices.show', $office) }}"/>
                                <x-button.edit class="btn-icon" route="{{ route('offices.edit', $office) }}"/>
                                <x-button.delete class="btn-icon" route="{{ route('offices.destroy', $office) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
                                <x-empty
                                    route="{{ route('offices.create') }}"
                                    title="{{ __('Kantor tidak ditemukan') }}"
                                    message="{{ __('Coba sesuaikan pencarian atau filter Anda untuk menemukan apa yang sedang Anda cari.') }}"
                                    buttonLabel="{{ __('Tambahkan kantor terlebih dahulu!') }}"
                                    buttonRoute="{{ route('offices.create') }}"
                                />
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $offices->firstItem() }}</span>
                    to <span>{{ $offices->lastItem() }}</span> of <span>{{ $offices->total() }}</span> entries
                </p>

                <ul class="pagination m-0 ms-auto">
                    {{ $offices->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
