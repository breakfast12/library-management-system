<?php

namespace Database\Seeders;

use App\Models\Author\Author;
use App\Models\Book\Book;
use Illuminate\Database\Seeder;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find author by id
        $id = Author::where('name', 'Jenna Zaiden')->first()->id;

        // Prepare catalogue data
        $catalogue = [
            [
                'title' => 'Sang Penguasa',
                'description' => 'Machiavelli sangat dihormati sebagai negarawan',
                'publish_date' => '2020-07-14',
                'author_id' => $id,
                'created_at' => now()->subMinutes(65),
                'updated_at' => now()->subMinutes(65),
            ],
            [
                'title' => 'The Habit Fix',
                'description' => 'Kesuksesan kita sangat bergantung pada hubungan dengan orang lain, yang dikenal sebagai relasi.',
                'publish_date' => '2020-07-15',
                'author_id' => $id,
                'created_at' => now()->subMinutes(70),
                'updated_at' => now()->subMinutes(70),
            ],
            [
                'title' => 'Titik Menuju Dewasa',
                'description' => 'Waktu terus berputar dan hakikatnya, setiap manusia mengalami perkembangan.',
                'publish_date' => '2024-07-10',
                'author_id' => $id,
                'created_at' => now()->subMinutes(75),
                'updated_at' => now()->subMinutes(75),
            ],
            [
                'title' => 'Business Intelligence',
                'description' => 'Buku ini merupakan respons terhadap kompleksitas dunia data scientist yang semakin dihujani dengan berbagai istilah yang semakin membingungkan',
                'publish_date' => '2023-09-4',
                'author_id' => $id,
                'created_at' => now()->subMinutes(80),
                'updated_at' => now()->subMinutes(80),
            ],
            [
                'title' => 'Menjadi Orang Sukses',
                'description' => 'Menjadi Orang Sukses : Mindset yang Perlu Dimiliki Jika Ingin Sukses',
                'publish_date' => '2024-06-04',
                'author_id' => $id,
                'created_at' => now()->subMinutes(85),
                'updated_at' => now()->subMinutes(85),
            ],
            [
                'title' => 'Rahasia Lancar Komunikasi',
                'description' => 'Agar sukses berkomunikasi, diperlukan kemampuan dasar berkomunikasi.',
                'publish_date' => '2024-06-05',
                'author_id' => $id,
                'created_at' => now()->subMinutes(90),
                'updated_at' => now()->subMinutes(90),
            ],
        ];

        // Insert catalogue in books
        Book::insert($catalogue);
    }
}
