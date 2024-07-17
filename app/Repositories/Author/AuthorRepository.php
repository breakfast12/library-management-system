<?php

namespace App\Repositories\Author;

use App\Models\Author\Author;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Author\AuthorContract;

class AuthorRepository extends BaseRepository implements AuthorContract
{
    protected $author;

    public function __construct(Author $author)
    {
        parent::__construct($author);
        $this->author = $author;
    }
}
