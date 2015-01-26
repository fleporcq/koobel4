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
	<div >
		<ul id="books" masonry preserve-order>
			<li ng-repeat="book in books" class="masonry-brick">
				<img class="cover" ng-src="covers/@{{book.id}}-@{{book.slug}}.jpg">
				<span class="title">@{{book.title}}</span>
			</li>
		</ul>
	</div>
@stop

@section('styles')
	<style type="text/css">
		ul#books {
			padding:0;
			margin:0;
			list-style: none;
		}
		ul#books > li{
			border:1px solid #eee;
			margin:10px;
			padding:10px;
			width:190px;
		}
		ul#books span.title{
			display: block;
			margin:10px 0 5px 0;
			text-align: center;
		}
		ul#books img.cover{
			max-width:100%;height:auto;
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