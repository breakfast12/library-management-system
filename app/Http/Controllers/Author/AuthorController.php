<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\ParamAuthorRequest;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\Author\DetailAuthorResource;
use App\Http\Resources\Author\ListAuthorResource;
use App\Http\Services\Author\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * The service instance to handle author operations.
     *
     * @var AuthorService
     */
    protected $service;

    /**
     * Constructor to initialize the service.
     *
     * @param AuthorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->service = $authorService;
    }

    /**
     * List of authors.
     *
     * @return ListAuthorResource|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Call the service to get the list of authors.
            $response = $this->service->indexService();

            // Return authors with status and message.
            return ListAuthorResource::collection($response)->additional([
                'status' => 'success',
                'message' => 'Authors data retrieved successfully.',
            ]);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Store a new author.
     *
     * @param StoreAuthorRequest
     * @return AuthorResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreAuthorRequest $request)
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
     * Show the detail author.
     *
     * @param ParamAuthorRequest
     * @param int
     * @return DetailAuthorResource|\Illuminate\Http\JsonResponse
     */
    public function show(ParamAuthorRequest $request, int $id)
    {
        try {
            // Call the service to find the author by id
            $response = $this->service->findService($id);

            // Return the author detail resource
            return new DetailAuthorResource($response);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Update existing author.
     *
     * @param UpdateAuthorRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAuthorRequest $request, int $id)
    {
        // Validate the input data from the request
        $inputData = $request->validated();

        try {
            // Call service to update author with validated data and id
            $this->service->updateService($inputData, $id);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Updated Author.',
            ], 200);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Soft delete author.
     *
     * @param ParamAuthorRequest
     * @param int
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ParamAuthorRequest $request, int $id)
    {
        try {
            // Call the service to soft delete the author by id
            $this->service->deleteService($id);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Deleted Author.',
            ], 200);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }
}
