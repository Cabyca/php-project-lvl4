@extends('layouts.app')
@section('content')
    <main class="container py-4">
        <h1 class="mb-5">Задачи</h1>
        <div class="d-flex mb-3">
            <div>
                {{ Form::open(['url' => route('tasks.index'), 'method' => 'get', 'class' => 'form-inline']) }}
                <div class="row g-1">
                    <div class="col">
                        {{ Form::select('filter[status_id]', $statuses, Arr::get($filter, 'status_id', ''), ['class' => 'form-select me-2', 'placeholder' => __('pages.task.models.status_id')]) }}
                    </div>
                    <div class="col">
                        {{ Form::select('filter[created_by_id]', $users, Arr::get($filter, 'created_by_id', ''), ['class' => 'form-select me-2', 'placeholder' => __('pages.task.models.createdBy')]) }}
                    </div>
                    <div class="col">
                        {{ Form::select('filter[assigned_to_id]', $users, Arr::get($filter, 'assigned_to_id', ''), ['class' => 'form-select me-2', 'placeholder' => __('pages.task.models.assignedTo')]) }}
                    </div>
                    <div class="col">
                        {{ Form::submit(__('pages.filters.submit'), ['class' => 'btn btn-outline-primary mr-2']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
{{--                <form method="GET" action="{{ route('tasks.index') }}" accept-charset="UTF-8">--}}
{{--                    @csrf--}}
{{--                    <form method="GET" action="https://php-task-manager-ru.hexlet.app/tasks" accept-charset="UTF-8">--}}
{{--                    <div class="row g-1">--}}
{{--                        <div class="col">--}}
{{--                            <select class="form-select me-2" name="filter[status_id]">--}}
{{--                                <option selected="selected" value="">Статус</option>--}}
{{--                                @foreach($taskStatuses as $taskStatus)--}}
{{--                                    @if(isset($filter) && $filter['status_id'] == $taskStatus->id)--}}
{{--                                        <option selected value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>--}}
{{--                                        @else <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="col">--}}
{{--                            <select class="form-select me-2" name="filter[created_by_id]">--}}
{{--                                <option selected="selected" value="">Автор</option>--}}
{{--                                @foreach($users as $user)--}}
{{--                                    @if(isset($filter) && $filter['created_by_id'] == $user->id)--}}
{{--                                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                                        @else <option value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div class="col">--}}
{{--                            <select class="form-select me-2" name="filter[assigned_to_id]">--}}
{{--                                <option selected="selected" value="">Исполнитель</option>--}}
{{--                                @foreach($users as $user)--}}
{{--                                    @if(isset($filter) && $filter['assigned_to_id'] == $user->id)--}}
{{--                                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                                    @else <option value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <input class="btn btn-outline-primary me-2" type="submit" value="Применить">--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </form>--}}
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
                @auth
                    <th>Действия</th>
                @endauth
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
                    <td>
                        @can('delete', $task)
                            <a class="text-danger text-decoration-none"
                               href="{{ route('tasks.destroy', $task) }}"
                               data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                        @endcan
                    </td>
                    <td>
                        @can('update', $task)
                            <a class="text-decoration-none" href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </main>
@endsection
