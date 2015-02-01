@extends('layouts.master',array(
	"htmlTagAttrs" => array(
		"ng-app" => "koobeApp"
	)
))
@section('content')
    <div flow-init="{target: '{{ URL::action('BookController@flow') }}'}"
         flow-files-submitted="$flow.upload()">
        <div class="drop" flow-drop ng-class="dropClass">
            <span class="btn btn-default" flow-btn>Upload File</span>
            <span class="btn btn-default" flow-btn flow-directory ng-show="$flow.supportDirectory">Upload Folder</span>
        </div>

        <br/>

        <div class="well">
            <a class="btn btn-small btn-success" ng-click="$flow.resume()">Resume all</a>
            <a class="btn btn-small btn-danger" ng-click="$flow.pause()">Pause all</a>
            <a class="btn btn-small btn-info" ng-click="$flow.cancel()">Cancel all</a>
            <span class="label label-info">Total Size: @{{$flow.getSize()}}bytes</span>
        </div>

        <div>

            <div ng-repeat="file in $flow.files" class="transfer-box">
                @{{file.relativePath}} (@{{file.size}}bytes)
                <div class="progress progress-striped" ng-class="{active: file.isUploading()}">
                    <div class="progress-bar" role="progressbar"
                         aria-valuenow="@{{file.progress() * 100}}"
                         aria-valuemin="0"
                         aria-valuemax="100"
                         ng-style="{width: (file.progress() * 100) + '%'}">
                        <span class="sr-only">@{{file.progress()}}% Complete</span>
                    </div>
                </div>
                <div class="btn-group">
                    <a class="btn btn-xs btn-warning" ng-click="file.pause()" ng-show="!file.paused && file.isUploading()">
                        Pause
                    </a>
                    <a class="btn btn-xs btn-warning" ng-click="file.resume()" ng-show="file.paused">
                        Resume
                    </a>
                    <a class="btn btn-xs btn-danger" ng-click="file.cancel()">
                        Cancel
                    </a>
                    <a class="btn btn-xs btn-info" ng-click="file.retry()" ng-show="file.error">
                        Retry
                    </a>
                </div>
            </div>
        </div>
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