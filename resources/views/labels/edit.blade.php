@extends('layouts.app')
@section('content')
    @auth
        <main class="container py-4">
            @include('forms.labelForm', [
                'header' => __('pages.label.edit.header'),
                'method' => 'put',
                'button' => __('pages.label.edit.submit'),
                'route' => route('labels.update', [$label->id])
            ])
        </main>
    @endauth
@endsection
