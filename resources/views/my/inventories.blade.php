@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card mb-3">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Kepemilikan Inventaris') }}
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
                    @forelse ($userInventories as $inventory)
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
                                <x-button.show class="btn-icon" route="{{ route('my.inventory.detail', $inventory) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="7">
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
        </div>
    </div>
</div>
@endsection
