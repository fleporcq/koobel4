<?php $appName = Config::get('app.name'); ?>
<!doctype html>
<html lang="fr" {{isset($htmlTagAttrs) ? HTML::attributes($htmlTagAttrs) : null}}>
    <head>
        <meta charset="UTF-8">
        <title>{{$title or $appName}}</title>
        {{ HTML::style('assets/stylesheets/main.css'); }}
        @section('styles')
        @show
        {{ HTML::script('assets/javascript/main.js'); }}
        {{ HTML::script('assets/javascript/angular.js'); }}
        {{ HTML::script('assets/javascript/masonry.js'); }}
    </head>
    <body {{isset($bodyTagAttrs) ? HTML::attributes($bodyTagAttrs) : null}}>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::action('HomeController@index') }}">{{ $appName }}</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ URL::action('HomeController@index') }}">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ URL::action('SecurityController@logout') }}"><span class="glyphicon glyphicon-off"></span>&nbsp;{{ Lang::get('messages.logout') }}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        @section('scripts')
        @show
    </body>
</html>
