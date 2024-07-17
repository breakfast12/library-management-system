<?php

namespace Tests\Feature;

use App\Models\Author\Author;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Tests\Traits\AuthCase;

class AuthorTest extends TestCase
{
    use AuthCase;

    private $token;

    #[Test]
    public function cant_insert_author_cause_name_required()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $author = [
            'name' => '',
            'bio' => 'Hidup harus dicobain',
            'birth_date' => '1998-10-10',
        ];

        $response = $this->postJson(route('api.authors.store'), $author, $this->token);

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Name is required.', $response->json()['message']['name'][0]);

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

        $response = $this->postJson(route('api.authors.store'), $author, $this->token);

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Bio is required.', $response->json()['message']['bio'][0]);

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

        $response = $this->postJson(route('api.authors.store'), $author, $this->token);

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Birth date is required.', $response->json()['message']['birth_date'][0]);

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

        $response = $this->postJson(route('api.authors.store'), $author, $this->token);

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Birth date must be valid date.', $response->json()['message']['birth_date'][0]);

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

        $response = $this->postJson(route('api.authors.store'), $author, $this->token);

        $response->assertCreated();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals('Successfully Store Author.', $response->json()['message']);

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

        $response = $this->postJson(route('api.authors.store'), $author, $this->token);

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Name has already been taken.', $response->json()['message']['name'][0]);

        $this->logout();
    }

    #[Test]
    public function cant_see_detail_author_cause_param_id_does_not_exist()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $response = $this->getJson(route('api.authors.show', ['id' => 99]), $this->token);

        $response->assertBadRequest();

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Author ID does not exist.', $response->json()['message']['id'][0]);

        $this->logout();
    }

    #[Test]
    public function can_see_detail_author()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $response = $this->getJson(route('api.authors.show', ['id' => $id]), $this->token);

        $response->assertOk();

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals('Successfully Show Detail Author.', $response->json()['message']);

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
        $this->assertEquals('Author ID does not exist.', $response->json()['message']['id'][0]);

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
        $this->assertEquals('Name is required.', $response->json()['message']['name'][0]);

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
        $this->assertEquals('Bio is required.', $response->json()['message']['bio'][0]);

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
        $this->assertEquals('Birth date is required.', $response->json()['message']['birth_date'][0]);

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
        $this->assertEquals('Birth date must be valid date.', $response->json()['message']['birth_date'][0]);

        $this->logout();
    }

    #[Test]
    public function cant_update_author_cause_name_already_been_taken()
    {
        $this->token = $this->login('admin@mailinator.com', 'password');

        $id = Author::latest()->first()->id;

        $author = [
            'name' => 'Klara Anaya',
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
        $this->assertEquals('Name has already been taken.', $response->json()['message']['name'][0]);

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
        $this->assertEquals('Successfully Updated Author.', $response->json()['message']);

        $this->logout();
    }
}
