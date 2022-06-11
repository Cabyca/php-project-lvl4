@extends('layouts.app')
@section('content')
    <main class="container py-4">
        @include('forms.labelForm', [
            'header' => __('pages.label.create.header'),
            'button' => __('pages.label.create.submit'),
            'route' => route('labels.store')
        ])
    </main>
@endsection
