<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function book() {
        return $this->hasMany('\Foobooks\Book');
    }

    public static function authorsForDropdown() {

        # Get all authors
        $authors = \Foobooks\Author::orderBy('last_name', 'ASC')->get();

        # Build array for author's dropdown
        $authors_for_dropdown = [];
        # key = author_id
        # values = last_name, first_name
        foreach($authors as $author) {
            $authors_for_dropdown[$author->id] = $author->last_name. ', ' . $author->first_name;
        }
        return $authors_for_dropdown;
    }
}
