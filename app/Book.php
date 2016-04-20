<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'published', 'cover', 'purchase_link'];

    public function author() {
        return $this->belongsTo('\Foobooks\Author');
    }
}
