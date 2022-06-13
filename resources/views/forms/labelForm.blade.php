<h1 class="mb-5">{{$header}}</h1>
{{ Form::model($label, ['url' => $route, 'method' => $method ?? 'post', 'class' => 'w-50']) }}
    {{ Form::bsText('name') }}
    {{ Form::bsTextarea('description') }}
    {{ Form::submit($button, ['class' => 'btn btn-primary mt-3']) }}
{{ Form::close() }}

