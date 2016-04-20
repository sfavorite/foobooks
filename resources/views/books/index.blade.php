@extends('layouts.master')

@section('title')
    All books
@stop

@section('content')

	
	<div class='book'>
		<h1>All the books</h1>
		@foreach($books as $book)
			<h2>{{ $book->title }}</h2>
			<img src='{{ $book->cover }}' alt='Cover for {{$book->title }}'>
			<a href='/book/edit/{{ $book->id }}'>Edit</a>
		@endforeach
	</div>
@stop
