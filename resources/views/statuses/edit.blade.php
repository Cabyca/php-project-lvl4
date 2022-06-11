@extends('layouts.app')
@section('content')
    <main class="container py-4">
        @include('forms.taskStatusForm', [
            'header' => __('pages.taskStatus.edit.header'),
            'method' => 'put',
            'button' => __('pages.taskStatus.edit.submit'),
            'route' => route('task_statuses.update', [$taskStatus->id])
        ])
    </main>
@endsection
