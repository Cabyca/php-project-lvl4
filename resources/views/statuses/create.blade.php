@extends('layouts.app')
@section('content')
    @auth
    <main class="container py-4">
        @include('forms.taskStatusForm', [
            'header' => __('pages.taskStatus.create.header'),
            'button' => __('pages.taskStatus.create.submit'),
            'route' => route('task_statuses.store')
        ])
    </main>
    @endauth
@endsection
