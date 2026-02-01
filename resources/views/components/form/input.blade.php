@props([
    'inputClassName' => null,
    'className' => null,
    'name' => null,
    'label',
    'type',
    'disabled' => false,
    'required' => false,
    'value',
    'placeholder',
    'errorBag' => null, // ⬅️ TAMBAHKAN
])

<div class="{{ $className }} mb-1" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        class="rounded-3 form-control {{ $inputClassName }} {{ $errors->{$errorBag ?? 'default'}->has($name) ? 'is-invalid' : '' }}"
        placeholder="{{ $placeholder ?? 'Input ' . $label }}"
        value="{{ isset($value) ? old($name, $value) : old($name) }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}>

    @if ($errors->{$errorBag ?? 'default'}->has($name))
        <div class="invalid-feedback" bis_skin_checked="1">
            {{ $errors->{$errorBag ?? 'default'}->first($name) }}
        </div>
    @endif
</div>

{{-- 
Cara Pakai :
<x-form.input className="col-md-4 mb-3" type="text" name="no_sticker" label="Nomor Stiker Angkasa Pura" value="{{ old('no_sticker') }}" />
--}}
