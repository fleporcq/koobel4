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
		<ul >
			<li ng-repeat="book in books">
				<img ng-src="covers/@{{book.id}}-@{{book.slug}}.jpg" width="100">
				<span>@{{book.title}}</span>
				<span>@{{book.year}}</span>
				<ul>
					<li ng-repeat="author in book.authors">@{{author.name}}</li>
				</ul>
				<ul>
					<li ng-repeat="theme in book.themes">@{{theme.name}}</li>
				</ul>
			</li>
		</ul>
	</div>
@stop

@section('styles')
	<style type="text/css">

	</style>
@stop

@section('scripts')
<script type="text/javascript">

	var homeApp = angular.module('homeApp', []);

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