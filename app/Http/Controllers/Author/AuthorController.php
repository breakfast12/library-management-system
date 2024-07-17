<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorRequest;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Services\Author\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * The service instance to handle author operations.
     *
     * @var \App\Services\AuthorService
     */
    protected $service;

    /**
     * Constructor to initialize the service.
     *
     * @param \App\Services\AuthorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->service = $authorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a new author.
     *
     * @param \App\Http\Requests\AuthorRequest
     * @return \App\Http\Resources\AuthorResource|\Illuminate\Http\JsonResponse
     */
    public function store(AuthorRequest $request)
    {
        // Validate the input data from the request
        $inputData = $request->validated();

        try {
            // Call the service to store the author with the validated data
            $response = $this->service->storeService($inputData);

            // Return the created author resource
            return new AuthorResource($response);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
