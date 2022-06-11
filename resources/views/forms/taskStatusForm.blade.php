<h1 class="mb-5">{{$header}}</h1>
{{ Form::model($taskStatus, ['url' => $route, 'method' => $method ?? 'post', 'class' => 'w-50']) }}
    {{ Form::bsText('name') }}
    {{ Form::submit($button, ['class' => 'btn btn-primary']) }}
{{ Form::close() }}

