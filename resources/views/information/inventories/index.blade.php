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
                <table class="table table-vcenter card-table text-nowrap">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle w-1">
                                {{ __('No') }}
                            </th>
                            <th  scope="col" class="align-middle">
                                {{ __('Nomor Seri') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Brand') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Model') }}
                            </th>
                            <th scope="col" class="align-middle">
                                {{ __('Aksi') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($userInventories as $inventory)
                        <tr>
                            <td class="align-middle">
                                {{ $loop->iteration }}
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
                            <td class="align-middle" style="width: 10%">
                                <x-button.show class="btn-icon" route="{{ route('information.inventories.show', $inventory) }}"/>
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
