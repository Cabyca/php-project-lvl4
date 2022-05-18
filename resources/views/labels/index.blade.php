@extends('layouts.app')
@section('content')
    <main class="container py-4">
        <h1 class="mb-5">Метки</h1>
        <a href="{{ route('labels.create') }}" class="btn btn-primary">
            Создать метку        </a>
        <table class="table mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Описание</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at }}</td>
                    <td>
                        <a class="text-danger text-decoration-none" href="https://php-task-manager-ru.hexlet.app/labels/1" data-confirm="Вы уверены?" data-method="delete">Удалить</a>
                        <a class="text-decoration-none" href="{{ route('labels.edit', $label->id) }}">Изменить</a>
                    </td>
{{--                    <td>--}}
{{--                        @can('delete', $status)--}}
{{--                            <a class="text-danger text-decoration-none"--}}
{{--                               href="{{ route('task_statuses.destroy', $status) }}"--}}
{{--                               data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>--}}

{{--                            --}}{{--                            <form method="post" class="delete_form" action="{{route('listajoburi.destroy',$row['id'])}}">--}}
{{--                            --}}{{--                                @csrf--}}
{{--                            --}}{{--                                @method('delete')--}}
{{--                            --}}{{--                            </form>--}}
{{--                        @endcan--}}
{{--                        @can('update', $status)--}}
{{--                            <a class="text-decoration-none" href="{{ route('task_statuses.edit', $status->id) }}">Изменить</a>--}}
{{--                        @endcan--}}
{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
