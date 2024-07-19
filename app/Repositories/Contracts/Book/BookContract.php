<?php

namespace App\Repositories\Contracts\Book;

interface BookContract
{
    // Register the repository method

    public function findWithAuthor($id);
}
