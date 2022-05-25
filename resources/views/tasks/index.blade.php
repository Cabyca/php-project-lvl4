@extends('layouts.app')
@section('content')
    <main class="container py-4">
        <h1 class="mb-5">Задачи</h1>
        <div class="d-flex mb-3">
            <div>
                <form method="GET" action="https://php-task-manager-ru.hexlet.app/tasks" accept-charset="UTF-8">
                    <div class="row g-1">
                        <div class="col">
                            <select class="form-select me-2" name="filter[status_id]">
                                <option selected="selected" value="">Статус</option>
                                <option value="1">новая1</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select me-2" name="filter[created_by_id]">
                                <option selected="selected" value="">Автор
                                <option value="33">foreachq</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select me-2" name="filter[assigned_to_id]">
                                <option selected="selected" value="">Исполнитель</option>
                            </select>
                        </div>
                        <div class="col">
                            <input class="btn btn-outline-primary me-2" type="submit" value="Применить">
                        </div>

                    </div></form>
            </div>
            @auth
            <div class="ms-auto">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">Создать задачу</a>
            </div>
            @endauth
        </div>

        <table class="table me-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Автор</th>
                <th>Исполнитель</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a href = "{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a>
                    </td>
                    <td>{{ $task->createdBy->name }}</td>
                    <td>{{ $task->assignedTo->name }}</td>
                    <td>{{ $task->created_at }}</td>
                    @auth
                    <td>
                        <a class="text-danger text-decoration-none"
                        href="{{ route('tasks.destroy', $task) }}"
                        data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                    </td>
                    @endauth
                    <td>
                        // Исправить
                        <a class="text-decoration-none" href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </main>
@endsection
