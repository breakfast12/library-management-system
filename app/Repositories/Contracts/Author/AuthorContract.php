<?php

namespace App\Repositories\Contracts\Author;

interface AuthorContract
{
    // Register the repository method

    public function getAuthors(
        $search,
        $birthDateFrom,
        $birthDateTo,
        $orderBy,
        $order,
        $perPage,
        $page
    );

    public function findWithBook($id, $perPage, $sortOrder, $page);
}
