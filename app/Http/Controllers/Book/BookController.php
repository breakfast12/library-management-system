<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\ParamBookRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\DetailBookResource;
use App\Http\Resources\Book\ListBookResource;
use App\Http\Services\Book\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * The service instance to handle book operations.
     *
     * @var BookService
     */
    protected $service;

    /**
     * Constructor to initialize the service.
     *
     * @param BookService
     */
    public function __construct(BookService $bookService)
    {
        $this->service = $bookService;
    }

    /**
     * List of books.
     *
     * @return ListBookResource|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Call the service to get the list of books.
            $response = $this->service->indexService();

            // Return books with status and message.
            return ListBookResource::collection($response)->additional([
                'status' => 'success',
                'message' => 'Books data retrieved successfully.',
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
     * Store a new book.
     *
     * @param StoreBookRequest
     * @return BookResource|\Illuminate\Http\JsonResponse
     */
    public function store(StoreBookRequest $request)
    {
        // Validate the input data from the request
        $inputData = $request->validated();

        try {
            // Call the service to store the book with the validated data
            $response = $this->service->storeService($inputData);

            // Return the created book resource
            return new BookResource($response);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Show the detail book with author.
     *
     * @param ParamBookRequest
     * @param int
     * @return DetailBookResource|\Illuminate\Http\JsonResponse
     */
    public function show(ParamBookRequest $request, int $id)
    {
        try {
            // Call the service to find the book by id
            $response = $this->service->findService($id);

            // Return the book detail resource
            return new DetailBookResource($response);
        } catch (\Throwable $th) {
            // Return an error response if something goes wrong
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage(),
            ], $th->getCode() ?: 400);
        }
    }

    /**
     * Update existing Book.
     *
     * @param UpdateBookRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookRequest $request, int $id)
    {
        // Validate the input data from the request
        $inputData = $request->validated();

        try {
            // Call service to update book with validated data and id
            $this->service->updateService($inputData, $id);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Updated Book.',
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
     * Soft delete book.
     *
     * @param ParamBookRequest
     * @param int
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ParamBookRequest $request, int $id)
    {
        try {
            // Call the service to soft delete the book by id
            $this->service->deleteService($id);

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Deleted Book.',
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
