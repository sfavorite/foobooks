<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Foobooks\Book;

class PracticeController extends Controller {

    public function getEx4() {

        # Instantiate a new Book Model object
        //$book = new \Foobooks\Book();
        $book = new Book();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $book->title = 'Harry Potter';
        $book->author = 'J.K. Rowling';
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9780590353427_p0_v1_s484x700.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harry-potter-and-the-sorcerers-stone-j-k-rowling/1100036321?ean=9780590353427';

        # Invoke the Eloquent save() method
        # This will generate a new row in the `books` table, with the above data
        $book->save();

        echo 'Added: '.$book->title;
    }

    public function getEx5() {

        $books = Book::all();

        foreach ($books as $book) {
            echo $book->title . '<br>';
        }
    }

    public function getEx6() {

        $book = Book::where('author', 'LIKE', '%Acott%')->first();

        if (! is_null($book)) {
            echo $book->count . '<br>';
            $book->title = 'The Really Great Gatsby';
            $book->save();
            echo 'Update complete';
        } else {
            echo 'Book not found';
        }

    }

    public function getEx7() {
        $book = Book::where('author', 'LIKE', '%Scott%')->first();

        if ($book) {
            $book->delete();
            return 'Deletion complete';
        } else {
            return 'Book not found.';
        }
    }

    public function getEx8() {
        $books = Book::orderBy('created_at', 'desc')->take(5)->get();
        if ($books) {
            foreach ($books as $book) {
                echo $book->title . '<br>';
            }
        }
    }

    public function getEx9() {
        $books = Book::where('published', '>', 1950)->get();
        if ($books) {
            foreach ($books as $book) {
                echo $book->title . '<br>';
            }
        }
    }

    public function getEx10() {
        $books = Book::orderBy('title', 'asc')->get();
        if ($books) {
            foreach ($books as $book) {
                echo $book->title . '<br>';
            }
        }
    }

    public function getEx11() {
        $books = Book::orderBy('published', 'desc')->get();
        if ($books) {
            foreach ($books as $book) {
                echo $book->title . '<br>';
            }
        }
    }

    public function getEx12() {
        $books = Book::where('author', 'Bell Hooks')->get();
        if (!$books->isEmpty()) {
            echo $books;
            foreach($books as $book) {
                $book->author = 'bell hooks';
                $book->save();
                echo 'Saved ' . $book->title;
            }
        } else {
            return 'Author not found';
        }
    }

    public function getEx13() {
        $books = Book::where('author', 'J.K. Rowling')->get();
        if (!$books->isEmpty()) {
            foreach($books as $book) {
                $book->delete();
                echo 'Deleted ' . $book->title . ' by ' . $book->author;
            }
        } else {
            return 'Author not found';
        }
    }

    public function getEx16() {
        $books = Book::where('published', '>', 1925)->get();
        echo 'All books';
        dump($books);
        echo 'First book: ' . $books->first()->title;
        dump($books->first());
        echo 'In an array';
        dump($books->toArray());
        // dd($books);
        return view('practice.output')->with('books', $books);
    }

    public function getEx17() {
        $books = \Foobooks\Book::get();

        foreach ($books as $book){
            echo $book->author->first_name.'<br>';
        }
    }

    public function getEx18() {
        $books = \Foobooks\Book::with('author')->get();
        foreach($books as $book) {
            echo $book->author->first_name.'<br>';
        }
    }

    public function getEx19() {
        $author = new \Foobooks\Author;
        $author->first_name = 'J.K';
        $author->last_name = 'Rowling';
        $author->bio_url = 'https://en.wikipedia.org/wiki/J._K._Rowling';
        $author->birth_year = '1965';
        $author->save();
        dump($author->toArray());

        $book = new \Foobooks\Book;
        $book->title = "Harry Potter and the Philosopher's Stone";
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());
    }

    public function getEx20() {
        $book = \Foobooks\Book::where('title', '=', 'The Great Gatsby')->first();

        dump($book->tags);

        foreach($book->tags as $tag) {
            echo $tag->name  . "<br>";
        }
    }

    public function getEx21() {
        $books = \Foobooks\Book::with('tags')->get();

        foreach ($books as $book) {
            echo $book->title . "<br>";
            foreach($book->tags as $tag) {
                echo $tag->name . "<br>";
            }
            echo "<br>";
        }
    }
}

?>
