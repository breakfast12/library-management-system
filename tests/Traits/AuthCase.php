<?php

namespace Tests\Traits;

trait AuthCase
{
    private $token;

    public function login($email, $password)
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->postJson(route('api.auth.login'), [
            'email' => $email,
            'password' => $password,
        ]);

        $this->token = $response->json()['data']['access_token'];

        return [
            'Authorization' => 'Bearer '.$this->token,
        ];
    }

    public function logout()
    {
        return $this->postJson(route('api.auth.logout'), $this->token);
    }
}
