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
                        @auth
                        <a class="text-danger text-decoration-none" href="{{ route('labels.destroy', $label) }}"
                           data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
                        <a class="text-decoration-none" href="{{ route('labels.edit', $label->id) }}">Изменить</a>
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
@endsection
