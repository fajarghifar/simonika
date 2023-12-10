@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Detail Pengguna Inventaris') }}
                    </h3>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label mb-1">Nama</label>
                            <p class="form-control form-control-solid ">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label mb-1">Jenis Kelamin</label>
                            <p class="form-control form-control-solid ">{{ $user->gender->label() }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label mb-1">Nomor Induk Pegawai (NIP)</label>
                            <p class="form-control form-control-solid ">{{ $user->nip }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label mb-1">Nomor Induk Kependudukan (NIK)</label>
                            <p class="form-control form-control-solid ">{{ $user->nik }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Inventaris') }}
                    </h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center w-1">
                                {{ __('No') }}
                            </th>
                            <th  scope="col" class="align-middle text-center">
                                {{ __('Nomor Seri') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Model') }}
                            </th>
                            <th scope="col" class="align-middle text-center">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($inventories as $inventory)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="align-middle text-center">
                                {{ $inventory->serial_number }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $inventory->brand->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $inventory->model }}
                            </td>
                            <td class="align-middle text-center" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('inventories.show', $inventory->id) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
                                <div class="empty">
                                    <div class="empty-icon">
                                        <x-icon.sad/>
                                    </div>
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
        </div>

        {{-- <div class="card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Kendaraan') }}
                    </h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center w-1">
                                {{ __('No') }}
                            </th>
                            <th  scope="col" class="align-middle text-center">
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
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="align-middle text-center">
                                {{ $vehicle->stnk_number }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $vehicle->license_plate }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $vehicle->brand->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $vehicle->model }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $vehicle->category->label() }}
                            </td>
                            <td class="align-middle text-center" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('vehicles.show', $vehicle->id) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
                                <div class="empty">
                                    <div class="empty-icon">
                                        <x-icon.sad/>
                                    </div>
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
        </div> --}}
    </div>
</div>
@endsection
