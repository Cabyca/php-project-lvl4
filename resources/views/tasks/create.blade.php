@extends('layouts.app')
@section('content')
    <main class="container py-4">
        @include('forms.taskForm', [
            'header' => __('pages.task.create.header'),
            'button' => __('pages.task.create.submit'),
            'route' => route('tasks.store')
        ])
{{--        <form method="POST" action="{{ route('tasks.store') }}" accept-charset="UTF-8" class="w-50">--}}
{{--           @csrf--}}
{{--            <div class="form-group mb-3">--}}
{{--                <label for="name">Имя</label>--}}
{{--                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">--}}
{{--                @error('name')--}}
{{--                        <div class="invalid-feedback">Задача с таким именем уже существует</div>--}}
{{--                    @enderror--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="description">Описание</label>--}}
{{--                <textarea class="form-control" name="description" cols="50" rows="10" id="description"></textarea>--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="status_id">Статус</label>--}}
{{--                <select class="form-control" id="status_id" name="status_id"> //ключ status_id значение $status->id--}}
{{--                    <option selected="selected" value="">----------</option>--}}
{{--                    @foreach($taskStatuses as $taskStatus)--}}
{{--                        <option value="{{ $taskStatus->id }}">{{ $taskStatus->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="assigned_to_id">Исполнитель</label>--}}
{{--                <select class="form-control" id="assigned_to_id" name="assigned_to_id">--}}
{{--                    <option selected="selected" value="">----------</option>--}}
{{--                    @foreach($users as $user)--}}
{{--                        <option value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="form-group mb-3">--}}
{{--                <label for="label">Метки</label>--}}
{{--                <select class="form-control" id="label" multiple="" name="labels[]">--}}
{{--                    <option value=""></option>--}}
{{--                    @foreach($labels as $label)--}}
{{--                        <option value="{{ $label->id }}">{{ $label->name }}</option>--}}
{{--                    @endforeach--}}
{{--            </div>--}}

{{--            <input class="btn btn-primary mt-3" type="submit" value="Создать">--}}
{{--        </form>--}}
    </main>
@endsection
