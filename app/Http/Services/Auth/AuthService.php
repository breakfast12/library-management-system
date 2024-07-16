<?php

namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Handle the login operation.
     *
     * @param array
     * @return \Illuminate\Contracts\Auth\Authenticatable
     *
     * @throws \Exception
     */
    public function login(array $credentials)
    {
        // Try to authenticate the user with the provided credentials
        if (! Auth::attempt($credentials)) {
            // Throw an exception if authentication fails
            throw new \Exception('Unauthorized', 401);
        }

        // Retrieve the authenticated user
        $user = Auth::user();
        // Get the secret key from the application configuration
        $secretKey = config('app.api_secret_key');
        // Generate an access token for the user
        $authToken = $user->createToken($secretKey)->accessToken;

        // Set the token type and access token for the user
        $user->token_type = 'Bearer';
        $user->access_token = $authToken;

        // Return the authenticated user with the access token
        return $user;
    }

    /**
     * Handle the logout operation.
     *
     * @return void
     */
    public function logout()
    {
        // Get the guard instance for the API authentication
        $userGuard = Auth::guard('api');

        // Check if the user is authenticated
        if ($userGuard->check()) {
            // Revoke the user token to log them out
            $userGuard->user()->token()->revoke();
        }
    }
}
