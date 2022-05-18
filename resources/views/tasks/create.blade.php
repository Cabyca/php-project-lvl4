@extends('layouts.app')
@section('content')
    <main class="container py-4">
        <h1 class="mb-5">Создать задачу</h1>
        <form method="POST" action="{{ route('tasks.store') }}" accept-charset="UTF-8" class="w-50">
           @csrf
            <div class="form-group mb-3">
                <label for="name">Имя</label>
                <input class="form-control" name="name" type="text" id="name">
            </div>

            <div class="form-group mb-3">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" cols="50" rows="10" id="description"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="status_id">Статус</label>
                <select class="form-control" id="status_id" name="status_id">
                    <option selected="selected" value="">----------</option>
{{--                    @foreach($taskStatuses as $item)--}}
{{--                        <option>{{ $item->name }}</option>--}}
{{--                    @endforeach--}}
{{--                    <option value="1">новая1</option>--}}
{{--                    <option value="2">завершена</option>--}}
{{--                    <option value="3">выполняется</option>--}}
{{--                    <option value="4">в а</option>--}}
{{--                    <option value="31">амбрелла</option>--}}
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="assigned_to_id">Исполнитель</label>
                <select class="form-control" id="assigned_to_id" name="assigned_to_id">
                    <option selected="selected" value="">----------</option>
                    <option value="1">Алёна Владимировна Ивановаа</option>
                    <option value="2">Максим Евгеньевич Кузьмин</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="labels">Метки</label>
                <select class="form-control" multiple="" name="labels[]"><option value="">
                    </option><option value="1">ошибка</option>
                    <option value="2">документация</option>
                    <option value="3">дубликат</option>
                    <option value="4">доработка</option></select>
            </div>

            <input class="btn btn-primary mt-3" type="submit" value="Создать">
        </form>
    </main>
@endsection
