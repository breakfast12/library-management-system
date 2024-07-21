<?php

namespace App\Repositories\Contracts\Book;

interface BookContract
{
    // Register the repository method

    public function getBooks(
        $search,
        $publishDateFrom,
        $publishDateTo,
        $orderBy,
        $order,
        $perPage,
        $page
    );

    public function findWithAuthor($id);
}
