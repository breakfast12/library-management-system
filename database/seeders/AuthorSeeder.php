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
                'bio' => 'lorem ipsum 2',
                'birth_date' => '1995-05-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cathrine Dino',
                'bio' => 'lorem ipsum 3',
                'birth_date' => '1998-08-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert author data
        Author::insert($authors);
    }
}
