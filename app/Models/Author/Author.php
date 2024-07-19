<?php

namespace App\Models\Author;

use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'bio',
        'birth_date',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
