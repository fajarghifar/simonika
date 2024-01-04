@props([
    'label',
    'name',
    'placeholder',
    'disabled' => null
])

<div class="mb-3">
    <label class="form-label">
        {{ $label }} <span class="text-danger">*</span>
    </label>

    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror" @isset($disabled) disabled @endisset>
        <option disabled>{{ $placeholder }}</option>
        {{ $slot }}
    </select>

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
