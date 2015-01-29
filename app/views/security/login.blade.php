<?php $appName = Config::get('app.name'); ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $appName }}</title>
    {{ HTML::style('assets/stylesheets/main.css'); }}
    {{ HTML::style('assets/stylesheets/login.css'); }}
</head>
<body>
    <div class="container">
        {{ Form::open(array('url' => URL::action('SecurityController@login'), 'class' => 'form-signin')) }}
            <h2 class="form-signin-heading">{{ $appName }}</h2>
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            {{ Form::label('email',Lang::get('messages.email'), array('class' => 'sr-only')) }}
            {{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => Lang::get('messages.email'))) }}
            {{ Form::label('password',Lang::get('messages.password'), array('class' => 'sr-only')) }}
            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => Lang::get('messages.password'))) }}
            {{ Form::submit(Lang::get('messages.signIn'), array('class'=> 'btn btn-lg btn-primary btn-block')) }}
        {{ Form::close() }}
    </div>
</body>
</html>