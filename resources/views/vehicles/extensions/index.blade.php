@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Laporan Perpanjang Kendaraan') }}
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
                            <th scope="col" class="align-middle">
                                @sortablelink('created_at', 'Tanggal Pengajuan')
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Nomor STNK') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Model') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Periode Pajak') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Periode STNK') }}
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
                    @forelse ($extensions as $extension)
                        <tr>
                            <td class="align-middle">
                                {{ ($extensions->currentPage() - 1) * $extensions->perPage() + $loop->iteration }}
                            </td>

                            <td class="align-middle text-secondary">
                                {{ \Carbon\Carbon::parse($extension->created_at)->format('d/m/Y') }}
                            </td>
                            <td class="align-middle">
                                {{ $extension->vehicle->stnk_number }}
                            </td>
                            <td class="align-middle">
                                {{ $extension->vehicle->model }}
                            </td>
                            <td class="align-middle">
                                    {{ $extension->tax_period ? \Carbon\Carbon::parse($extension->tax_period)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="align-middle">
                                    {{ $extension->stnk_period ? \Carbon\Carbon::parse($extension->stnk_period)->format('d/m/Y') : '-' }}
                            </td>

                            <td class="align-middle">
                                <x-status
                                    dot color="{{ $extension->status === \App\Enums\VehicleExtensionStatus::APPROVED ? 'green' : 'orange' }}"
                                    class="text-uppercase"
                                >
                                    {{ $extension->status->label() }}
                                </x-status>
                            </td>
                            <td class="align-middle d-flex">
                                <x-button.show class="btn-icon me-1" route="{{ route('vehicles.extensions.show', $extension) }}"/>
                                @if (!$extension->approved_by)
                                <form action="{{ route('vehicles.extensions.update', $extension) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <x-button.save class="btn-icon btn-outline-success" onclick="return confirm('Apakah Anda yakin untuk menyetujui pengajuan ini?')">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                    </x-button.save>
                                </form>
                                @endif
                                <x-button.delete class="btn-icon ms-1" route="{{ route('vehicles.extensions.destroy', $extension) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="9">
                                <div class="empty">
                                    <p class="empty-title">
                                        {{ __('Tidak ada riwayat pengajuan!') }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-secondary">
                    Showing <span>{{ $extensions->firstItem() }}</span>
                    to <span>{{ $extensions->lastItem() }}</span> of <span>{{ $extensions->total() }}</span> entries
                </p>

                <ul class="pagination m-0 ms-auto">
                    {{ $extensions->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
