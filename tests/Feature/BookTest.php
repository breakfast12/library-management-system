<?php

namespace Tests\Feature;

use App\Models\Author\Author;
use App\Models\Book\Book;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Tests\Traits\AuthCase;

class BookTest extends TestCase
{
    use AuthCase;

    private $token;

    #[Test]
    public function can_see_list_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->getJson(
            route('api.books.index'),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function can_search_by_title_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'search' => 'you',
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );
        $this->assertEquals(
            'Today I Miss You',
            $response->json()['data'][0]['title']
        );

        $this->logout();
    }

    #[Test]
    public function can_search_by_description_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'search' => 'horor',
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );
        $this->assertEquals(
            'Wingit menceritakan kisah-kisah mistis atau horor',
            $response->json()['data'][0]['description']
        );

        $this->logout();
    }

    #[Test]
    public function can_search_by_author_name_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'search' => 'dana',
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );
        $this->assertEquals(
            'Siana Dana',
            $response->json()['data'][0]['author']['name']
        );

        $this->logout();
    }

    #[Test]
    public function can_order_by_title_asc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'title',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_title_desc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'title',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_description_asc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'description',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_description_desc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'description',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_publish_date_asc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'publish_date',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_publish_date_desc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'publish_date',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_author_name_asc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'author_name',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::with('author')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->orderBy('authors.name', $params['order'])
            ->select('books.*', 'authors.name as author_name')
            ->paginate($params['per_page']);

        $expectedBooks = $orderedBooks->pluck('author_name')->toArray();

        $responseBooks = collect($response->json()['data'])
            ->pluck('author.name')
            ->toArray();

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_author_name_desc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'author_name',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::with('author')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->orderBy('authors.name', $params['order'])
            ->select('books.*', 'authors.name as author_name')
            ->paginate($params['per_page']);

        $expectedBooks = $orderedBooks->pluck('author_name')->toArray();

        $responseBooks = collect($response->json()['data'])
            ->pluck('author.name')
            ->toArray();

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_created_at_asc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'created_at',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_created_at_desc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'created_at',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_updated_at_asc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'updated_at',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_order_by_updated_at_desc_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'updated_at',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $orderedBooks = Book::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseBooks = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function can_filter_by_publish_date_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'publish_date_from' => '2017-10-01',
            'publish_date_to' => '2018-09-30',
        ];

        $response = $this->getJson(
            route('api.books.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Books data retrieved successfully.',
            $response->json()['message']
        );

        $expectedBooks = Book::whereBetween('publish_date', [$params['publish_date_from'], $params['publish_date_to']])
            ->orderBy('created_at', 'desc')
            ->get();

        $responseBooks = collect($response->json()['data']);
        $expectedBooks = $expectedBooks->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'publish_date' => Carbon::parse($book->publish_date)->format('Y-m-d'),
                'author' => [
                    'id' => $book->author->id,
                    'name' => $book->author->name,
                ],
                'created_at' => Carbon::parse($book->created_at)->toDateTimeString(),
                'updated_at' => Carbon::parse($book->updated_at)->toDateTimeString(),
            ];
        });

        $this->assertEquals($expectedBooks->toArray(), $responseBooks->toArray());

        $this->logout();
    }

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
    public function cant_see_detail_book_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->getJson(
            route('api.books.show', ['id' => 99]),
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
    public function can_see_detail_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::latest()->first()->id;

        $response = $this->getJson(
            route('api.books.show', ['id' => $id]),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Show Detail Book.',
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

    #[Test]
    public function cant_delete_book_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->deleteJson(
            route('api.books.update', ['id' => 99]),
            [],
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
    public function can_delete_book()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Book::first()->id;

        $response = $this->deleteJson(
            route('api.books.update', ['id' => $id]),
            [],
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Deleted Book.',
            $response->json()['message']
        );

        $this->logout();
    }
}
