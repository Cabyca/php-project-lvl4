<h1 class="mb-5">{{ $header }}</h1>
{{ Form::model($task, ['url' => $route, 'method' => $method ?? 'post', 'class' => 'w-50']) }}
    {{ Form::bsText('name') }}
    {{ Form::bsTextarea('description') }}
    {{ Form::bsSelect('status_id', $statuses->pluck('name','id'), null, ['formName' => 'task']) }}
    {{ Form::bsSelect('assigned_to_id', $users->pluck('name','id'), null, ['formName' => 'task']) }}
    {{ Form::bsSelect('labels', $labels->pluck('name','id'), $task->labels, ['formName' => 'task', 'multiple' => 'multiple']) }}
    {{ Form::submit($button, ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
