<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Koobe</title>
        {{ HTML::style('assets/stylesheets/main.css'); }}
        @section('styles')
        @show
        {{ HTML::script('assets/javascript/main.js'); }}
        {{ HTML::script('assets/javascript/angular.js'); }}
    </head>
    <body>
        @yield('content')
        @section('scripts')
        @show
    </body>
</html>
