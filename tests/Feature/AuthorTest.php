<?php

namespace Tests\Feature;

use App\Models\Author\Author;
use App\Models\Book\Book;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Tests\Traits\AuthCase;

class AuthorTest extends TestCase
{
    use AuthCase;

    private $token;

    #[Test]
    public function can_see_list_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->getJson(
            route('api.authors.index'),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function can_search_by_name_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'search' => 'jon',
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );
        $this->assertEquals('Emmy Jonna', $response->json()['data'][0]['name']);

        $this->logout();
    }

    #[Test]
    public function can_search_by_bio_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'search' => 'xi',
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );
        $this->assertEquals('lorem xixi 3', $response->json()['data'][0]['bio']);

        $this->logout();
    }

    #[Test]
    public function can_order_by_name_asc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'name',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_name_desc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'name',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_bio_asc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'bio',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_bio_desc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'bio',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_birth_date_asc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'birth_date',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_birth_date_desc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'birth_date',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_created_at_asc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'created_at',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_created_at_desc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'created_at',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_updated_at_asc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'updated_at',
            'order' => 'asc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_order_by_updated_at_desc_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'order_by' => 'updated_at',
            'order' => 'desc',
            'per_page' => 10,
            'page' => 1,
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $orderedAuthors = Author::orderBy($params['order_by'], $params['order'])
            ->get()
            ->pluck($params['order_by'])
            ->toArray();
        $responseAuthors = collect($response->json()['data'])
            ->pluck($params['order_by'])
            ->toArray();

        $expectedAuthors = array_slice($orderedAuthors, 0, $params['per_page']);

        $this->assertEquals($expectedAuthors, $responseAuthors);

        $this->logout();
    }

    #[Test]
    public function can_filter_by_birth_date_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'birth_date_from' => '1993-06-01',
            'birth_date_to' => '1995-05-31',
        ];

        $response = $this->getJson(
            route('api.authors.index', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Authors data retrieved successfully.',
            $response->json()['message']
        );

        $expectedAuthors = Author::whereBetween('birth_date', [$params['birth_date_from'], $params['birth_date_to']])
            ->orderBy('created_at', 'desc')
            ->get();

        $responseAuthors = collect($response->json()['data']);
        $expectedAuthors = $expectedAuthors->map(function ($author) {
            return [
                'id' => $author->id,
                'name' => $author->name,
                'bio' => $author->bio,
                'birth_date' => Carbon::parse($author->birth_date)->format('Y-m-d'),
                'created_at' => Carbon::parse($author->created_at)->toDateTimeString(),
                'updated_at' => Carbon::parse($author->updated_at)->toDateTimeString(),
            ];
        });

        $this->assertEquals($expectedAuthors->toArray(), $responseAuthors->toArray());

        $this->logout();
    }

    #[Test]
    public function cant_insert_author_cause_name_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => '',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->postJson(
            route('api.authors.store'),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Name is required.',
            $response->json()['message']['name'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_author_cause_bio_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => 'Klara Anaya',
            'bio' => '',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->postJson(
            route('api.authors.store'),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Bio is required.',
            $response->json()['message']['bio'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_author_cause_birth_date_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => 'Klara Anaya',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '',
        ];

        $response = $this->postJson(
            route('api.authors.store'),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Birth date is required.',
            $response->json()['message']['birth_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_author_cause_birth_date_must_be_valid_date()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => 'Klara Anaya',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => 'abc',
        ];

        $response = $this->postJson(
            route('api.authors.store'),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Birth date must be valid date.',
            $response->json()['message']['birth_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_insert_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => 'Klara Anaya',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->postJson(
            route('api.authors.store'),
            $author,
            $this->token
        );

        $response->assertCreated();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Store Author.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function cant_insert_author_cause_name_already_been_taken()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => 'Klara Anaya',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->postJson(
            route('api.authors.store'),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Name has already been taken.',
            $response->json()['message']['name'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_see_detail_author_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->getJson(
            route('api.authors.show', ['id' => 99]),
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author ID does not exist.',
            $response->json()['message']['id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_see_detail_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $response = $this->getJson(
            route('api.authors.show', ['id' => $id]),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Show Detail Author.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function cant_see_catalogue_author_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $params = [
            'id' => 99,
            'per_page' => 5,
        ];

        $response = $this->getJson(
            route('api.authors.catalogue', $params),
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author ID does not exist.',
            $response->json()['message']['id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_see_catalogue_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::where('name', 'Jenna Zaiden')->first()->id;

        $params = [
            'id' => $id,
            'per_page' => 5,
        ];

        $response = $this->getJson(
            route('api.authors.catalogue', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Show Author Catalogue.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function can_sort_catalogue_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::where('name', 'Jenna Zaiden')->first()->id;

        $params = [
            'id' => $id,
            'per_page' => 5,
            'sort' => 'asc',
        ];

        $response = $this->getJson(
            route('api.authors.catalogue', $params),
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Show Author Catalogue.',
            $response->json()['message']
        );

        $orderedBooks = Book::where('author_id', $id)
            ->orderBy('publish_date', $params['sort'])
            ->get()
            ->pluck('publish_date')
            ->toArray();

        $responseBooks = collect($response->json()['data']['books']['data'])
            ->pluck('publish_date')
            ->toArray();

        $expectedBooks = array_slice($orderedBooks, 0, $params['per_page']);

        $this->assertEquals($expectedBooks, $responseBooks);

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => 'Kimaya',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => 99]),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author ID does not exist.',
            $response->json()['message']['id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_name_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => '',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => $id]),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Name is required.',
            $response->json()['message']['name'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_bio_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => 'Frederick Mariam',
            'bio' => '',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => $id]),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Bio is required.',
            $response->json()['message']['bio'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_birth_date_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => 'Frederick Mariam',
            'bio' => 'lorem ipsum 4',
            'birth_date' => '',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => $id]),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Birth date is required.',
            $response->json()['message']['birth_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_birth_date_must_be_valid_date()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => 'Frederick Mariam',
            'bio' => 'lorem ipsum 4',
            'birth_date' => 'abc',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => $id]),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Birth date must be valid date.',
            $response->json()['message']['birth_date'][0]
        );

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_name_already_been_taken()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => 'Cathrine Dino',
            'bio' => 'lorem ipsum 4',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => $id]),
            $author,
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Name has already been taken.',
            $response->json()['message']['name'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_update_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => 'Alma Sharyn',
            'bio' => 'lorem ipsum 4',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->putJson(
            route('api.authors.update', ['id' => $id]),
            $author,
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals(
            'Successfully Updated Author.',
            $response->json()['message']
        );

        $this->logout();
    }

    #[Test]
    public function cant_delete_author_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->deleteJson(
            route('api.authors.destroy', ['id' => 99]),
            [],
            $this->token
        );

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals(
            'Author ID does not exist.',
            $response->json()['message']['id'][0]
        );

        $this->logout();
    }

    #[Test]
    public function can_delete_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $response = $this->deleteJson(
            route('api.authors.destroy', ['id' => $id]),
            [],
            $this->token
        );

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals('Successfully Deleted Author.', $response->json()['message']);

        $this->logout();
    }

    #[Test]
    public function unauthorized_test()
    {
        $response = $this->getJson(
            route('api.authors.index')
        );

        $response->assertUnauthorized();

        $this->assertEquals('failed', $response->json()['status']);
        $this->assertEquals('Unauthenticated.', $response->json()['message']);
    }
}
