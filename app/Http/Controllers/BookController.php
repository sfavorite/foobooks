<?php

namespace Foobooks\Http\Controllers;

use Foobooks\Http\Controllers\Controller;

class BookController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
            return view('books.list');
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

            /* Or in an array */
            return view('books.show', ['title' => $title, 'abc' => '123']);

    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        return 'Form to create a new book';
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate() {
        return 'Process adding new book';
    }
}

?>
