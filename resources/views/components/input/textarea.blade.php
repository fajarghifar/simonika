@props([
    'label' => null ?? ucfirst($name),
    'type'  => null ?? 'text',
    'name',
    'id'    => null ?? $name,
    'row'   => null ?? '3',
    'placeholder' => null,
    'autocomplete' => null ?? 'off',
    'readonly' => false,
    'disabled' => false,
    'required' => false,
    'value' => null ?? old($name)
])

<div class="mb-3">
    <label for="{{ $id }}"
            class="form-label @error($name) text-danger @enderror {{ $required ? 'required' : '' }}"
    >
        {{ __($label) }}
    </label>

    <textarea type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            rows="{{ $row }}"
            class="form-control @error($name) is-invalid @enderror"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ $readonly ? 'readonly' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
    >{{ $value }}</textarea>

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
