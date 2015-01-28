@extends('layouts.master',array(
	"title" => "Koobe",
	"htmlTagAttrs" => array(
		"ng-app" => "homeApp",
		"ng-controller" => "HomeCtrl"
	),
	"bodyTagAttrs" => array(
		"when-scrolled" => "loadMoreBooks()"
	)
))
@section('content')
	<ul id="books" masonry="">
		<li ng-repeat="book in books" class="masonry-brick">
			<img class="cover" ng-src="covers/@{{book.id}}-@{{book.slug}}.jpg">
			<span class="title">@{{book.title}}</span>
		</li>
	</ul>
@stop

@section('styles')
	<style type="text/css">
		ul#books {
			padding:0;
			margin:0 auto;
			list-style: none;
		}
		ul#books > li{
			background-color: #fff;
			border:1px solid #eee;
			padding:10px;
			margin: 20px;
			width:16%;
			min-width:150px;
		}
		@media only screen and (max-width: 600px) {
			ul#books > li{
				width:42%;
			}
		}
		ul#books span.title{
			display: block;
			margin:10px 0 5px 0;
			text-align: center;
		}
		ul#books img.cover{
			max-width:100%;
			height:auto;
		}
		.masonry-brick {
			margin: 1em;
			display: none;
		}

		.masonry-brick.loaded {
			display: block;
		}
	</style>
@stop

@section('scripts')
<script type="text/javascript">

	var homeApp = angular.module('homeApp', ['wu.masonry']);

	homeApp.directive('whenScrolled', function ($document) {
		return {
			restrict: 'A',
			scope: {
				whenScrolled: "&"
			},
			link: function (scope, elem, attrs) {
				rawElement = elem[0];
				$(window).bind('scroll', function () {
					if($(window).scrollTop() + $(window).height() + 5 >= $document.height()) {
						scope.$apply(scope.whenScrolled);
					}
				});
			}
		};
	});
	homeApp.controller('HomeCtrl', function ($scope, $http) {
		$scope.books = [];
		$scope.page = 1;
		$scope.lastPage = null;
		$scope.loadMoreBooks = function() {
			if ($scope.lastPage == null || $scope.page <= $scope.lastPage) {
				$http.get('books?page=' + $scope.page).success(function (page) {

						$scope.books = $scope.books.concat(page.data);

					$scope.lastPage = page.last_page;
				});
				$scope.page++;
			}
		}
		$scope.loadMoreBooks();
	});




</script>
@stop