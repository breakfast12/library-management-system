<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'name',
        'bio',
        'birth_date',
    ];
}
