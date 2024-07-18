<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Resources\Book\BookResource;
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

    public function index()
    {
        //
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

    public function show(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
