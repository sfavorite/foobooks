<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
		
			$books = \Foobooks\Book::orderBy('id', 'desc')->get();
            return view('books.index')->with('books', $books);
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($title = null) {

            /* Can send data with multiple 'with' statements
            return view('books.show')
            ->with('title', $title)
            ->with('abc', '123');
            */

            /* Or in an array
            return view('books.show', ['title' => $title, 'abc' => '123']);
            */

            return view('books.show', [
                'title' => '$title',
            ]);



    }
	
	
    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        return view('books.create');
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:3',
            'author' => 'required',
			'published' => 'required|min:4',
			'cover' => 'required|url',
			'purchase_link' => 'required|url',
        ]);
		
		/*
		# Add the book
		$book = new \Foobooks\Book();
		$book->title = $request->title;
		$book->author = $request->author;
		$book->published = $request->published;
		$book->cover = $request->cover;
		$book->purchase_link = $request->purchase_link;
		$book->save();
		*/
		# Add the book with mass assignment
		$data = $request->only('title', 'author', 'published', 'cover', 'purchase_link');
		$book = new \Foobooks\Book($data);
		$book->save();
		
		# Or mass assign with the facade
		#\Foobooks\Book::create($data);
		
		# Send a flash message
		# Can use the method
		#$request->session()->flash('message', 'Your book was added!');
		# or the facade
		\Session::flash('message', 'Your book was added');
		
        #return 'Add the book: ' . $request->input('title');
		return redirect('/books');
    }
	
	public function getEdit($id) {
		$book = \Foobooks\Book::find($id);
		
		return view('books.edit')->with('book', $book);
	}
	
	public function postEdit(Request $request) {
		
		$book = \Foobooks\Book::find($request->id);
		
		$book->title = $request->title;
		$book->author = $request->author;
		$book->published = $request->published;
		$book->cover = $request->cover;
		$book->purchase_link = $request->purchase_link;
		
		$book->save();
		
		\Session::flash('message', 'Your changes were saved.');
		return redirect('/book/edit/' . $request->id);
		
	}
	
}

?>
