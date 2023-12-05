@props([
    'label',
    'name',
    'placeholder',
])

<div class="mb-3">
    <label class="form-label">
        {{ $label }} <span class="text-danger">*</span>
    </label>

    <select name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option selected="" disabled="">{{ $placeholder }}</option>
        {{ $slot }}
    </select>

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
