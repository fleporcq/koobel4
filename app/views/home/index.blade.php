@extends('layouts.master')

@section('content')
	<div data-ng-app="booksApp">
		<div data-ng-controller="BooksCtrl">
			<ul class="panel" when-scrolled="loadMoreBooks()">
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
	</div>
@stop

@section('styles')
	<style type="text/css">
		ul[when-scrolled]{
			max-height: 200px;
			overflow: auto;
			list-style-type: none;
		}
	</style>
@stop

@section('scripts')
<script type="text/javascript">

	var booksApp = angular.module('booksApp', []);

	booksApp.directive('whenScrolled', function () {
		return {
			restrict: 'A',
			scope :{
				whenScrolled: "&"
			},
			link: function (scope, elem, attrs) {
				rawElement = elem[0];
				elem.bind('scroll', function () {
					if((rawElement.scrollTop + rawElement.offsetHeight+5) >= rawElement.scrollHeight){
						scope.$apply(scope.whenScrolled);
					}
				});
			}
		};
	});

	booksApp.controller('BooksCtrl', function ($scope, $http) {

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