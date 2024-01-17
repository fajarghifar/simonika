@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Data Kepemilikan Kendaraan') }}
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
                                {{ __('Nomor STNK') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Nomor Polisi') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Model') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Kategori') }}
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
                    @forelse ($userVehicles as $vehicle)
                        <tr>
                            <td class="align-middle">
                                {{ $loop->iteration }}
                            </td>

                            <td class="align-middle">
                                {{ $vehicle->stnk_number }}
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
                                <span class="badge bg-{{ $vehicle->category === \App\Enums\VehicleCategory::MOBIL ? 'blue' : 'orange' }} text-blue-fg">{{ $vehicle->category->label() }}</span>
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
                            <td class="align-middle" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('information.vehicles.show', $vehicle) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="9">
                                <div class="empty">
                                    <p class="empty-title">
                                        Tidak ada riwayat peminjaman!
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
                    Showing <span>{{ $userVehicles->firstItem() }}</span>
                    to <span>{{ $userVehicles->lastItem() }}</span> of <span>{{ $userVehicles->total() }}</span> entries
                </p>

                <ul class="pagination m-0 ms-auto">
                    {{ $userVehicles->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
