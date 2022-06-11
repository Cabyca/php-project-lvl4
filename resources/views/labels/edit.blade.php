@extends('layouts.app')
@section('content')
    @auth
        <main class="container py-4">
            @include('forms.labelForm', [
                'header' => __('pages.label.edit.header'),
                'method' => 'put',
                'button' => __('pages.label.edit.submit'),
                'route' => route('labels.update', [$label->id])
            ])
{{--            <h1 class="mb-5">Изменение метки</h1>--}}
{{--            <form method="POST" action="{{ route('labels.update', $label->id) }}" accept-charset="UTF-8" class="w-50">--}}
{{--                <input name="_method" type="hidden" value="PATCH">--}}
{{--                @csrf--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="name">Имя</label>--}}
{{--                    <input class="form-control" name="name" type="text" value="{{ $label->name }}" id="name">--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <label for="description">Описание</label>--}}
{{--                    <textarea class="form-control" name="description" cols="50" rows="10"--}}
{{--                              id="description">{{ $label->description }}</textarea>--}}
{{--                </div>--}}
{{--                value="{{ $label->description }}"--}}
{{--                <input class="btn btn-primary mt-3" type="submit" value="Обновить">--}}
{{--            </form>--}}
        </main>
    @endauth
@endsection
