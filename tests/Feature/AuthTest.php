<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthTest extends TestCase
{
    private function credential($email, $password): array
    {
        return [
            'email' => $email,
            'password' => $password,
        ];
    }

    #[Test]
    public function admin_cant_login_cause_unauthorized()
    {
        $response = $this->postJson(
            route('api.auth.login'),
            $this->credential('admin@mailinator.com', 'password123')
        );

        $response->assertUnauthorized();

        $this->assertEquals('failed', $response->json()['status']);
        $this->assertEquals('Unauthorized', $response->json()['message']);
    }

    #[Test]
    public function admin_cant_login_cause_email_required()
    {
        $response = $this->postJson(
            route('api.auth.login'),
            $this->credential('', 'password')
        );

        $response->assertStatus(400);

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Email address is required.', $response->json()['message']['email'][0]);
    }

    #[Test]
    public function admin_cant_login_cause_email_not_valid()
    {
        $response = $this->postJson(
            route('api.auth.login'),
            $this->credential('admin', 'password')
        );

        $response->assertStatus(400);

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Please provide a valid email address.', $response->json()['message']['email'][0]);
    }

    #[Test]
    public function admin_cant_login_cause_password_required()
    {
        $response = $this->postJson(
            route('api.auth.login'),
            $this->credential('admin@mailinator.com', '')
        );

        $response->assertStatus(400);

        $this->assertEquals('error', $response->json()['status']);
        $this->assertEquals('Please enter your password.', $response->json()['message']['password'][0]);
    }

    #[Test]
    public function admin_can_login()
    {
        $response = $this->postJson(
            route('api.auth.login'),
            $this->credential('admin@mailinator.com', 'password')
        );

        $response->assertStatus(200);

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals('Successfully Logged In.', $response->json()['message']);

        return $response->json()['data']['access_token'];
    }

    #[Test]
    #[Depends('admin_can_login')]
    public function admin_can_logout($token)
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->postJson(route('api.auth.logout'));

        $response->assertStatus(200);

        $this->assertEquals('success', $response->json()['status']);
        $this->assertEquals('Successfully logged out.', $response->json()['message']);
    }
}
