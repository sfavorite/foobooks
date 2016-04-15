@foreach($books as $book)
    {{ $book->title . ' by ' .$book->author }}<br><br>
@endforeach
