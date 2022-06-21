@extends('layouts.app')
@section('content')
{{--    <main class="container py-4">--}}
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
                    @php
                        $assignedTo = $task->assignedTo->name ?? null
                    @endphp
                    <td>{{ $assignedTo ? $task->assignedTo->name : ''}}</td>
                    <td>{{ $task->created_at->format('d.m.Y') }}</td>
                    <td>
                        @can('delete', $task)
                            <a class="text-danger text-decoration-none"
                               href="{{ route('tasks.destroy', $task) }}"
                               data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                        @endcan
                        @can('update', $task)
                            <a class="text-decoration-none" href="{{ route('tasks.edit', $task->id) }}">Изменить</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
{{--    </main>--}}
@endsection
