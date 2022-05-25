@extends('layouts.app')
@section('content')
    <main class="container py-4">
        <h1 class="mb-5">
            Просмотр задачи: {{ $task->name }}
            <a href="{{ route('tasks.edit', $task->id) }}">⚙</a>
        </h1>
        <p>Имя: {{ $task->name }}</p>
        <p>Статус: {{ $task->status->name }}</p>
        <p>Описание: {{ $task->description }}</p>
{{--        <p>Метки: {{ $task->labels()->wherePivot('label_id', '=', '1') }}</p>--}}
        <p>Метки: {{ $task->labels }}</p>
        <ul>
{{--            @foreach($task->label_task as $label)--}}
{{--                <li>{{ $label->name }}</li>--}}
{{--            @endforeach--}}
        </ul>
    </main>
@endsection
