@extends('layouts.app')
@section('content')
    @auth
<main class="container py-4">
    <h1 class="mb-5">Изменение статуса</h1>
    <form method="POST" action="{{ route('task_statuses.update', $taskStatus->id) }}" accept-charset="UTF-8" class="w-50"><input name="_method" type="hidden" value="PATCH">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Имя</label>
            <input class="form-control" name="name" type="text" value="{{ $taskStatus->name }}" id="name">
        </div>
        <input class="btn btn-primary mt-3" type="submit" value="Обновить">
    </form>
</main>
    @endauth
@endsection
