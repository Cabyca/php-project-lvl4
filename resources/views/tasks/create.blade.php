@extends('layouts.app')
@section('content')
    <main class="container py-4">
        @include('forms.taskForm', [
            'header' => __('pages.task.create.header'),
            'button' => __('pages.task.create.submit'),
            'route' => route('tasks.store')
        ])
    </main>
@endsection
