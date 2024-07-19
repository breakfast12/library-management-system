<?php

namespace Documentation\Swagger\Book;

use Documentation\Swagger\Swagger;

class BookFeature extends Swagger
{
    /**
     * @OA\Post(
     *    path="/api/books",
     *    tags={"Book"},
     *    summary="Store Book",
     *    description="Create a new book and returns the created book data.",
     *    security={{"passport":{}}},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      description="Book data",
     *
     *      @OA\JsonContent(
     *        example={
     *          "title": "Laut Bercerita",
     *          "description": "Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017",
     *          "publish_date": "2017-10-23",
     *          "author_id": 1
     *        }
     *      ),
     *
     *      @OA\Schema(
     *          type="object",
     *          required={"title", "description", "publish_date", "author_id"},
     *
     *          @OA\Property(property="title", type="string"),
     *          @OA\Property(property="description", type="text"),
     *          @OA\Property(property="publish_date", type="date"),
     *          @OA\Property(property="author_id", type="integer"),
     *      ),
     *    ),
     *
     *    @OA\Response(
     *        response=201,
     *        description="Created",
     *
     *        @OA\JsonContent(
     *           example={
     *              "status": "success",
     *              "message": "Successfully Store Book.",
     *              "data": {
     *                  "title": "Laut Bercerita",
     *                  "description": "Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017",
     *                  "publish_date": "2017-10-23",
     *                  "author_name": "Sylvester Robert",
     *                  "created_at": "2024-07-18 16:08:28",
     *                  "updated_at": "2024-07-18 16:08:28"
     *               }
     *           }
     *        ),
     *     ),
     *
     *     @OA\Response(
     *        response=400,
     *        description="Bad Request",
     *
     *        @OA\JsonContent(
     *
     *          @OA\Examples(
     *              example="error-1",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "title": {
     *                          "Title is required."
     *                      }
     *                  }
     *              },
     *              summary="Title is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-2",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "description": {
     *                          "Description is required."
     *                      }
     *                  }
     *              },
     *              summary="Description is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-3",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "publish_date": {
     *                          "Publish Date is required."
     *                      }
     *                  }
     *              },
     *              summary="Publish Date is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-4",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "publish_date": {
     *                          "Publish Date must be valid date."
     *                      }
     *                  }
     *              },
     *              summary="Publish Date must be valid date.",
     *          ),
     *          @OA\Examples(
     *              example="error-5",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "author_id": {
     *                          "Author is required."
     *                      }
     *                  }
     *              },
     *              summary="Author is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-6",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "author_id": {
     *                          "Author ID must be valid integer."
     *                      }
     *                  }
     *              },
     *              summary="Author ID must be valid integer.",
     *          ),
     *          @OA\Examples(
     *              example="error-7",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "author_id": {
     *                          "Author does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Author does not exist.",
     *          ),
     *        ),
     *     ),
     *
     *     @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *
     *        @OA\JsonContent(
     *
     *          @OA\Examples(
     *              example="error-1",
     *              value={
     *                  "message": "Unauthenticated."
     *              },
     *              summary="Unauthenticated.",
     *          ),
     *        ),
     *     ),
     * )
     */
    public function store()
    {
        //
    }

    /**
     * @OA\Put(
     *    path="/api/books/{id}",
     *    tags={"Book"},
     *    summary="Update book",
     *    description="Update book and returns success response.",
     *    security={{"passport":{}}},
     *
     *    @OA\Parameter(
     *         name="id",
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *    ),
     *
     *    @OA\RequestBody(
     *      required=true,
     *      description="Book data",
     *
     *      @OA\JsonContent(
     *        example={
     *          "title": "Laut Bercerita",
     *          "description": "Laut Bercerita adalah novel yang diterbitkan oleh Kepustakaan Populer Gramedia (KPG) Jakarta pada tahun 2017",
     *          "publish_date": "2017-10-23",
     *          "author_id": 1
     *        }
     *      ),
     *
     *      @OA\Schema(
     *          type="object",
     *          required={"title", "description", "publish_date", "author_id"},
     *
     *          @OA\Property(property="title", type="string"),
     *          @OA\Property(property="description", type="text"),
     *          @OA\Property(property="publish_date", type="date"),
     *          @OA\Property(property="author_id", type="integer"),
     *      ),
     *    ),
     *
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(
     *           example={
     *              "status": "success",
     *              "message": "Successfully Updated Book."
     *           }
     *        ),
     *     ),
     *
     *     @OA\Response(
     *        response=400,
     *        description="Bad Request",
     *
     *        @OA\JsonContent(
     *
     *          @OA\Examples(
     *              example="error-1",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "id": {
     *                          "Book ID does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Book ID does not exist.",
     *          ),
     *          @OA\Examples(
     *              example="error-2",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "title": {
     *                          "Title is required."
     *                      }
     *                  }
     *              },
     *              summary="Title is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-3",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "description": {
     *                          "Description is required."
     *                      }
     *                  }
     *              },
     *              summary="Description is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-4",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "publish_date": {
     *                          "Publish Date is required."
     *                      }
     *                  }
     *              },
     *              summary="Publish Date is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-5",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "publish_date": {
     *                          "Publish Date must be valid date."
     *                      }
     *                  }
     *              },
     *              summary="Publish Date must be valid date.",
     *          ),
     *          @OA\Examples(
     *              example="error-6",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "author_id": {
     *                          "Author is required."
     *                      }
     *                  }
     *              },
     *              summary="Author is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-7",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "author_id": {
     *                          "Author does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Author does not exist.",
     *          ),
     *          @OA\Examples(
     *              example="error-8",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "author_id": {
     *                          "Author ID must be valid integer."
     *                      }
     *                  }
     *              },
     *              summary="Author ID must be valid integer.",
     *          ),
     *        ),
     *     ),
     *
     *     @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *
     *        @OA\JsonContent(
     *
     *          @OA\Examples(
     *              example="error-1",
     *              value={
     *                  "message": "Unauthenticated."
     *              },
     *              summary="Unauthenticated.",
     *          ),
     *        ),
     *     ),
     * )
     */
    public function update()
    {
        //
    }
}
