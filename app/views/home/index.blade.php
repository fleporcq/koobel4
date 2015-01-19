@extends('layouts.master')

@section('content')
	<ul>
		@foreach ($books as $book)
			<li><img src="{{ URL::action('BookController@cover', array("name"=>$book->id . "-" . $book->slug)) }}">{{ $book->title }} ({{ $book->year }})</li>
		@endforeach
	</ul>
@stop