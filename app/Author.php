<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function book() {
        return $this->hasMany('\Foobooks\Book');
    }
}
