<?php

namespace Database\Seeders;

use App\Models\Author\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prepare author data
        $authors = [
            [
                'name' => 'Sylvester Robert',
                'bio' => 'lorem ipsum',
                'birth_date' => '2000-02-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vanda Dirkje',
                'bio' => 'lorem haha 2',
                'birth_date' => '1995-05-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cathrine Dino',
                'bio' => 'lorem xixi 3',
                'birth_date' => '1998-08-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Murad Hilaire',
                'bio' => 'lorem zaza 4',
                'birth_date' => '2002-04-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emmy Jonna',
                'bio' => 'lorem koko 5',
                'birth_date' => '1993-06-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Surya Admetos',
                'bio' => 'lorem xaxa 6',
                'birth_date' => '1990-04-24',
                'created_at' => now()->addHours(1),
                'updated_at' => now()->addHours(1),
            ],
            [
                'name' => 'Eino Kondwani',
                'bio' => 'lorem ipsum 6',
                'birth_date' => '1999-10-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siana Dana',
                'bio' => 'lorem ipsum 7',
                'birth_date' => '1991-12-12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jenna Zaiden',
                'bio' => 'lorem ipsum 8',
                'birth_date' => '2001-11-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andrey Gela',
                'bio' => 'lorem ipsum 9',
                'birth_date' => '1990-05-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Collyn Elisa',
                'bio' => 'lorem ipsum 10',
                'birth_date' => '2005-10-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Feray Azure',
                'bio' => 'lorem ipsum 11',
                'birth_date' => '1997-04-26',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert author data
        Author::insert($authors);
    }
}
