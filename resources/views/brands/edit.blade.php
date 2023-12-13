@extends('layouts.dashboard')

@section('content')
<div class="page-body">
    <div class="container-xl">

        <x-alert/>

        <div class="card">
            <form action="{{ route('brands.update', $brand->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Edit Brand') }}
                        </h3>
                    </div>

                    <div class="card-actions">
                        <x-action.close route="{{ route('brands.index') }}" />
                    </div>
                </div>

                <div class="card-body">
                    <x-input label="Nama"
                                name="name"
                                id="name"
                                placeholder="Nama Brand"
                                value="{{ old('name', $brand->name) }}"
                    />

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category"
                                class="form-select @error('category') is-invalid @enderror"
                        >
                            <option disabled="">Pilih kategori:</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->value }}" {{ $brand->category->value == $category->value ? 'selected' : '' }}>
                                    {{ $category->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer text-end">
                    <x-button.save type="submit">
                        {{ __('Simpan') }}
                    </x-button.save>
                    <x-button class="btn btn-warning" route="{{ route('brands.index') }}">
                        {{ __('Batal') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
