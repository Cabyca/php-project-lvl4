@php
    $sectionName = $options['formName'] ?? 'default';
@endphp
<div class="form-group mb-3">
    {{ Form::label($name, __("pages.forms.{$sectionName}.{$name}")) }}
    {{
        Form::textarea($name, $value,
        ['class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control mb-3'])
    }}
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

