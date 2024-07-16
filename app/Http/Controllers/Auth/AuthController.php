<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * The authentication service instance.
     *
     * @var AuthService
     */
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @param AuthService
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle a login request.
     *
     * @param AuthRequest
     * @return \Illuminate\Http\JsonResponse|LoginResource
     */
    public function login(AuthRequest $request)
    {
        // Validate the request data
        $inputData = $request->validated();

        try {
            // Try to log the user in
            $response = $this->service->login($inputData);

            // Return the login resource on success
            return new LoginResource($response);
        } catch (\Throwable $th) {
            // Return a JSON response with the error message on failure
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Handle a logout request.
     *
     * @param Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Log the user out
        $this->service->logout();

        // Return a JSON response indicating successful logout
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out.',
        ], 200);
    }
}
