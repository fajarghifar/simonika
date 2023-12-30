@extends('layouts.dashboard')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ $inventory->model }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Riwayat') }}
                    </h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-vcenter card-table text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle w-1">
                                {{ __('No') }}
                            </th>
                            <th  scope="col" class="align-middle">
                                {{ __('Nama') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Tanggal Pinjam') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Tanggal Kembali') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($inventory_details as $log)
                        <tr>
                            <td class="align-middle">
                                {{ $loop->iteration }}
                            </td>

                            <td class="align-middle">
                                {{ $log->user->name }}
                            </td>
                            <td class="align-middle">
                                {{ $log->borrowed_date }}
                            </td>
                            <td class="align-middle">
                                {{ $log->returned_date }}
                            </td>
                            <td class="align-middle">
                                <x-status
                                    dot color="{{ $log->status === \App\Enums\VehicleDetailStatus::KEMBALI ? 'green' : 'orange' }}"
                                    class="text-uppercase"
                                >
                                    {{ $log->status->label() }}
                                </x-status>
                            </td>
                            <td class="align-middle" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('users.show', $log->user) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
                                <div class="empty">
                                    <p class="empty-title">
                                        Tidak ada riwayat peminjaman!
                                    </p>
                                    <p class="empty-subtitle text-secondary">
                                        Barang ini belum pernah dipinjamkan, sehingga tidak memiliki riwayat peminjaman.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
