<?php

namespace Database\Seeders;

use App\Models\Book\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prepare book data
        $books = [
            [
                'title' => 'Melangkah',
                'description' => 'Melangkah bertemakan tentang petualangan di Indonesia',
                'publish_date' => '2020-03-22',
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Wingit',
                'description' => 'Wingit menceritakan kisah-kisah mistis atau horor',
                'publish_date' => '2020-12-15',
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Almond',
                'description' => 'Almond adalah novel yang memberi harapan kepada orang seperti saya yang percaya bahwa hati dapat mengendalikan kepala.',
                'publish_date' => '2019-03-31',
                'author_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Di Hadapan Rahasia',
                'description' => 'Kumpulan puisi yang meromantisasi rindu, sebuah peratapan dalam penantian, sampai memelihara harapan yang sepi dalam satu jiwa',
                'publish_date' => '2020-01-19',
                'author_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Melihat Pengarang Tidak Bekerja',
                'description' => 'Serupa perbuatan baik lain, menulis itu selalu sulit ditunaikan. Dihadapkan ragam rintangan yang coba menghadang',
                'publish_date' => '2022-05-22',
                'author_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Perburuan Piring Emas',
                'description' => 'Di tengah sebuah pesta topeng yang digelar oleh Stuyvesant Randolph, seorang jutawan pemilik Seven Oaks, terjadi sebuah pencurian yang sangat berani',
                'publish_date' => '2022-03-21',
                'author_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Arah Musim',
                'description' => 'Seperti musim yang selalu berganti,isi dari buku ini juga mengingatkan manusia dengan segala perannya.',
                'publish_date' => '2019-10-13',
                'author_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Today I Miss You',
                'description' => 'Dari yang tak biasa untuk bertegur sapa, menjadi biasa. Sampai akhirnya ada rasa gugup yang hinggap di dalam dada saat berjumpa.',
                'publish_date' => '2019-12-22',
                'author_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tanah Putih',
                'description' => 'Kau telah membuatku kembali percaya bahwa cinta adalah sebuah kemerdekaan.',
                'publish_date' => '2019-08-31',
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pertanda',
                'description' => 'Pertanda adalah kumpulan kisah nyata tentang tanda datangnya kematian seseorang.',
                'publish_date' => '2019-09-02',
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Derana',
                'description' => 'Buku yang berjudul Derana ini merupakan novel karya diterbitkan oleh penerbit Transmedia pada Juni tahun 2019.',
                'publish_date' => '2019-06-12',
                'author_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Overtime',
                'description' => 'Kamulah satu-satunya yang aku inginkan. Sekaligus, satu-satunya yang belum aku miliki.',
                'publish_date' => '2018-09-03',
                'author_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert book data
        Book::insert($books);
    }
}
