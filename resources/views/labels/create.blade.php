@extends('layouts.app')
@section('content')

{{--    <div class="form-group">--}}
{{--        {{ Form::label($name, null, ['class' => 'control-label']) }}--}}
{{--        {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}--}}
{{--    </div>--}}

    <main class="container py-4">
        <h1 class="mb-5">Создать метку</h1>
        {{ Form::model($label, ['route' => 'labels.store']) }}
{{--        <form method="POST" action="{{ route('labels.store') }}" accept-charset="UTF-8" class="w-50">--}}
{{--           @csrf--}}
            <div class="form-group mb-3">
                {{ Form::label('name', 'Имя') }}
                {{ Form::text('name') }}<br>


{{--                <label for="name">Имя</label>--}}
{{--                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">--}}
{{--                @error('name')--}}
{{--                <div class="invalid-feedback">Метка с таким именем уже существует</div>--}}
{{--                @enderror--}}

            </div>

            {{ Form::label('description', 'Описание') }}
            {{ Form::textarea('description') }}<br>

            <div class="form-group mb-3">
{{--                <label for="description">Описание</label>--}}
{{--                <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ old('description') }}</textarea>--}}
            </div>

            {{ Form::submit('Создать') }}
            {{ Form::close() }}

{{--            <input class="btn btn-primary mt-3" type="submit" value="Создать">--}}
{{--        </form>--}}
    </main>
@endsection
