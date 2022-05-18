@extends('layouts.app')
@section('content')
    @auth
        <main class="container py-4">
            <h1 class="mb-5">Изменение метки</h1>
            <form method="POST" action="{{ route('labels.update', $label) }}" accept-charset="UTF-8" class="w-50">
                @csrf
{{--                <input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="SJUZsDBg01Z6S2n0IKXNvKz0botXostx6qwyxTbe">--}}

                <div class="form-group mb-3">
                    <label for="name">Имя</label>
                    <input class="form-control" name="name" type="text" value="{{ $label->name }}" id="name">
                </div>

                <div class="form-group mb-3">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ $label->description }}</textarea>
                </div>

                <input class="btn btn-primary mt-3" type="submit" value="Обновить">
            </form>
        </main>
    @endauth
@endsection
