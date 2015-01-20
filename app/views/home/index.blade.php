@extends('layouts.master')

@section('content')
<ul class="books" ng-app="booksApp" ng-controller="BookListCtrl">
	<li ng-repeat="book in books">
		<img src="covers/@{{book.id}}-@{{book.slug}}.jpg" width="100">
		<span>@{{book.title}}</span>
		<span>@{{book.year}}</span>
		<span><li ng-repeat="author in book.authors">@{{author.name}}</span>
	</li>
</ul>
@stop

@section('scripts')
<script type="text/javascript">
	var booksApp = angular.module('booksApp', []);

	booksApp.controller('BookListCtrl', function ($scope, $http) {
		$http.get('books').success(function(page) {
			$scope.books = page.data;
		});

	});
</script>
@stop