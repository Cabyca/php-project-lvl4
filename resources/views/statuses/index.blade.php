@extends('layouts.app')
@section('content')
    <main class="container py-4">
        <h1 class="mb-5">Статусы</h1>
        @auth
        <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">
            Создать статус</a>
        @endauth
        <table class="table mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                @auth
                    <th>Действия</th>
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach ($statuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->created_at }}</td>
                    <td>
                        @can('delete', $status)
                            <a class="text-danger text-decoration-none" href="{{ route('task_statuses.destroy', $status->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                        @endcan
                        @can('update', $status)
                            <a class="text-decoration-none" href="{{ route('task_statuses.edit', $status->id) }}">Изменить</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
