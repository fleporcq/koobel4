@extends('layouts.master')

@section('content')
	<ul>
		@foreach ($books as $book)
			<li>{{$book->title}} ({{$book->year}})</li>
		@endforeach
	</ul>
@stop