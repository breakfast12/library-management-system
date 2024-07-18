<?php

namespace App\Models\Book;

use App\Models\Author\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'description',
        'publish_date',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
