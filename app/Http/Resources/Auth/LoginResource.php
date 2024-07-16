<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'message' => 'Successfully Logged In.',
            'data' => [
                'user' => [
                    'name' => $this->name,
                    'email' => $this->email,
                ],
                'token_type' => $this->token_type,
                'access_token' => $this->access_token,
            ],
        ];
    }
}
