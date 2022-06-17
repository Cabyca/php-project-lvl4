@extends('layouts.app')
@section('content')
    @auth
        <main class="container py-4">
            @include('forms.taskForm', [
                'header' => __('pages.task.edit.header', ['name' => $task->name]),
                'method' => 'put',
                'button' => __('pages.task.edit.submit'),
                'route' => route('tasks.update', [$task->id])
            ])
        </main>
    @endauth
@endsection
