@extends('layouts.app')
@section('content')
    @auth
        <main class="container py-4">
            <h1 class="mb-5">Изменение задачи</h1>
            <form method="POST" action="{{ route('tasks.update', $task->id) }}" accept-charset="UTF-8" class="w-50">
                <input name="_method" type="hidden" value="PATCH">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Имя</label>
                    <input class="form-control" name="name" type="text" value="{{ $task->name }}" id="name">
                </div>

                <div class="form-group mb-3">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" cols="50" rows="10" id="description">{{ $task->description }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="status_id">Статус</label>
                    <select class="form-control" id="status_id" name="status_id">
                        <option value="">----------</option>
                        <option value="1" selected="selected">{{ $task->status->name }}</option>
                        @foreach($taskStatuses as $taskStatus)
                            <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="assigned_to_id">Исполнитель</label>
                    <select class="form-control" id="assigned_to_id" name="assigned_to_id">
                        <option value="">----------</option>
                        <option value='1' selected="selected">{{ $task->assignedTo->name }}</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="label">Метки</label>
                    <select class="form-control" id="label" multiple="" name="labels[]">
                        <option value=""></option>
{{--                        <option value='1' selected="selected">{{ $task->labels->name }}</option>--}}
                        @foreach($labels as $label)
                            <option value="{{ $label->id }}">{{ $label->name }}</option>
                    @endforeach
                </div>

                <input class="btn btn-primary mt-3" type="submit" value="Обновить">
            </form>
        </main>
    @endauth
@endsection
