@extends('layouts.master')


@section('head')
    <link href='/css/book/show.css' rel='stylesheet'>
@stop
@section('content')


    <h1>Book List</h1>
    <ul>
        <li>Pride and Prejudice - Jane Austen</li>
        <li>1984 - George Orwell</li>
        <li>Crime and Punsihment - Fyodor Dostoyevsky</li>
        <li>The Stranger - Albert Camus</li>
        <li>One Hundred Years of Solitude - Gabriel Garcia Marquez</li>
        <li>The Odyssey - Homer</li>
    </ul>
@stop

@section('body')
    <script src="/js/book/show.js"></script>
@stop
