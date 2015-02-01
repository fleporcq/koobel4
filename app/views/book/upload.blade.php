@extends('layouts.master',array(
	"htmlTagAttrs" => array(
		"ng-app" => "koobeApp"
	)
))
@section('content')
    <div flow-init="{target: '/books/flow'}" flow-files-submitted="$flow.upload()" flow-file-success="$file.msg = $message">
        <input type="file" flow-btn/>
        <span class="btn" flow-btn>Upload File</span>

        <table>
            <tr ng-repeat="file in $flow.files">
                <td>@{{$index+1}}</td>
                <td>@{{file.name}}</td>
                <td>@{{file.msg}}</td>
            </tr>
        </table>
    </div>
@stop

@section('styles')

@stop

@section('scripts')

{{ HTML::script('assets/javascript/angular.js'); }}
{{ HTML::script('assets/javascript/ng-flow.js'); }}

    <script type="text/javascript">

        var koobeApp = angular.module('koobeApp', ['flow'])
            .config(['flowFactoryProvider', function (flowFactoryProvider) {
                flowFactoryProvider.defaults = {
                    target: 'upload.php',
                    permanentErrors: [404, 500, 501],
                    maxChunkRetries: 1,
                    chunkRetryInterval: 5000,
                    simultaneousUploads: 4
                };
                flowFactoryProvider.on('catchAll', function (event) {
                    console.log('catchAll', arguments);
                });
                // Can be used with different implementations of Flow.js
                // flowFactoryProvider.factory = fustyFlowFactory;
            }]);
    </script>
@stop