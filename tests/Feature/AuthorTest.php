<?php

namespace Tests\Feature;

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

        $response->assertStatus(400);

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

        $response->assertStatus(400);

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

        $response->assertStatus(400);

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

        $response->assertStatus(400);

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

        $response->assertStatus(400);

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Name has already been taken.', $response->json()['message']['name'][0]);

        $this->logout();
    }
}
