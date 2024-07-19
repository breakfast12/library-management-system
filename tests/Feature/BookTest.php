<?php

namespace Tests\Feature;

use App\Models\Author\Author;
use App\Models\Book\Book;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Tests\Traits\AuthCase;

class BookTest extends TestCase
{
    use AuthCase;

    private $token;

    #[Test]
    public function cant_insert_book_cause_title_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => '',
            'description' => 'Laut Bercerita adalah novel karya Leila S. Chudori yang diterbitkan oleh Kepustakaan Populer Gramedia Jakarta pada tahun 2017',
            'publish_date' => '2017-10-23',
            'author_id' => 1,
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Title is required.',
            $response->json()['message']['title'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_book_cause_description_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Laut Bercerita',
            'description' => '',
            'publish_date' => '2017-10-23',
            'author_id' => 1,
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Description is required.',
            $response->json()['message']['description'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_book_cause_publish_date_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Laut Bercerita',
            'description' => 'Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017',
            'publish_date' => '',
            'author_id' => 1,
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Publish Date is required.',
            $response->json()['message']['publish_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_book_cause_publish_date_must_be_valid_date()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Laut Bercerita',
            'description' => 'Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017',
            'publish_date' => 'abc',
            'author_id' => 1,
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Publish Date must be valid date.',
            $response->json()['message']['publish_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_book_cause_author_id_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Laut Bercerita',
            'description' => 'Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017',
            'publish_date' => '2017-10-23',
            'author_id' => '',
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author is required.',
            $response->json()['message']['author_id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_book_cause_author_id_must_be_valid_integer()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Laut Bercerita',
            'description' => 'Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017',
            'publish_date' => '2017-10-23',
            'author_id' => 'abc',
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author ID must be valid integer.',
            $response->json()['message']['author_id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_book_cause_author_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Laut Bercerita',
            'description' => 'Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017',
            'publish_date' => '2017-10-23',
            'author_id' => 99,
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author does not exist.',
            $response->json()['message']['author_id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_insert_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::first()->id;

        $book = [
            'title' => 'Laut Bercerita',
            'description' => 'Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017',
            'publish_date' => '2017-10-23',
            'author_id' => $id,
        ];

        $response = $this->postJson(
            route('api.books.store'),
            $book,
            $this->token
        );

        $response->assertCreated();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Store Book.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '2022-02-23',
            'author_id' => 2,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => 99]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Book ID does not exist.',
            $response->json()['message']['id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_title_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => '',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '2022-02-23',
            'author_id' => 2,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Title is required.',
            $response->json()['message']['title'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_description_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => '',
            'publish_date' => '2022-02-23',
            'author_id' => 2,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Description is required.',
            $response->json()['message']['description'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_publish_date_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '',
            'author_id' => 2,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Publish Date is required.',
            $response->json()['message']['publish_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_publish_date_must_be_valid_date()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => 'abc',
            'author_id' => 2,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Publish Date must be valid date.',
            $response->json()['message']['publish_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_author_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '2022-02-23',
            'author_id' => '',
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author is required.',
            $response->json()['message']['author_id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_author_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '2022-02-23',
            'author_id' => 99,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author does not exist.',
            $response->json()['message']['author_id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_book_cause_author_must_be_valid_integer()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '2022-02-23',
            'author_id' => 'abc',
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author ID must be valid integer.',
            $response->json()['message']['author_id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_update_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $book = [
            'title' => 'Brianna dan Bottomwise',
            'description' => 'John Musiciante kehilangan gitarnya karena ulah kriminal amatir.',
            'publish_date' => '2022-02-23',
            'author_id' => 2,
        ];

        $response = $this->putJson(
            route('api.books.update', ['id' => $id]),
            $book,
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Updated Book.',
            $response->json()['message']
        );

        $this->logout();
    }
}
