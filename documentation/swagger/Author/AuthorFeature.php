<?php

namespace Documentation\Swagger\Author;

use Documentation\Swagger\Swagger;

class AuthorFeature extends Swagger
{
    /**
     * @OA\Get(
     *    path="/api/authors",
     *    tags={"Author"},
     *    summary="List authors",
     *    description="Get list authors and can search, sorting and filter.",
     *    security={{"passport":{}}},
     *
     *    @OA\Parameter(
     *         name="search",
     *         in="query",
     *
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         description="Search term for name or bio"
     *    ),
     *
     *    @OA\Parameter(
     *        name="birth_date_from",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string",
     *            format="date"
     *        ),
     *        description="Filter authors born after this date"
     *    ),
     *
     *    @OA\Parameter(
     *        name="birth_date_to",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string",
     *            format="date"
     *        ),
     *        description="Filter authors born before this date"
     *    ),
     *
     *    @OA\Parameter(
     *        name="order_by",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string"
     *        ),
     *        description="Column to order by (name, bio, birth_date, created_at, updated_at)"
     *    ),
     *
     *    @OA\Parameter(
     *        name="order",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string",
     *            enum={"asc", "desc"}
     *        ),
     *        description="Order direction"
     *    ),
     *
     *    @OA\Parameter(
     *        name="per_page",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="integer"
     *        ),
     *        description="Number of results per page"
     *    ),
     *
     *    @OA\Parameter(
     *        name="page",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="integer"
     *        ),
     *        description="Page number for pagination"
     *    ),
     *
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(
     *           example={
     *              "data": {
     *                  {
     *                      "id": 1,
     *                      "name": "Sylvester Robert",
     *                      "bio": "lorem ipsum",
     *                      "birth_date": "2000-02-15",
     *                      "created_at": "2024-07-18 03:22:34",
     *                      "updated_at": "2024-07-18 03:22:34"
     *                  },
     *                  {
     *                      "id": 2,
     *                      "name": "Vanda Dirkje",
     *                      "bio": "lorem ipsum 2",
     *                      "birth_date": "1995-05-20",
     *                      "created_at": "2024-07-18 03:22:34",
     *                      "updated_at": "2024-07-18 03:22:34"
     *                  },
     *                  {
     *                      "id": 3,
     *                      "name": "Cathrine Dino",
     *                      "bio": "lorem ipsum 3",
     *                      "birth_date": "1998-08-11",
     *                      "created_at": "2024-07-18 03:22:34",
     *                      "updated_at": "2024-07-18 03:22:34"
     *                  },
     *                  {
     *                      "id": 4,
     *                      "name": "Murad Hilaire",
     *                      "bio": "lorem ipsum 4",
     *                      "birth_date": "2002-04-15",
     *                      "created_at": "2024-07-18 03:22:34",
     *                      "updated_at": "2024-07-18 03:22:34"
     *                  },
     *                  {
     *                      "id": 5,
     *                      "name": "Emmy Jonna",
     *                      "bio": "lorem koko 5",
     *                      "birth_date": "1993-06-20",
     *                      "created_at": "2024-07-18 06:08:43",
     *                      "updated_at": "2024-07-18 06:08:43"
     *                  },
     *              },
     *              "links": {
     *                  "first": "http://127.0.0.1:8000/api/authors?page=1",
     *                  "last": "http://127.0.0.1:8000/api/authors?page=1",
     *                  "prev": null,
     *                  "next": null
     *              },
     *              "meta": {
     *                  "current_page": 1,
     *                  "from": 1,
     *                  "last_page": 1,
     *                  "links": {
     *                      {
     *                          "url": null,
     *                          "label": "&laquo; Previous",
     *                          "active": false
     *                      },
     *                      {
     *                          "url": "http://127.0.0.1:8000/api/authors?page=1",
     *                          "label": "1",
     *                          "active": true
     *                      },
     *                      {
     *                          "url": null,
     *                          "label": "Next &raquo;",
     *                          "active": false
     *                      }
     *                  },
     *                  "path": "http://127.0.0.1:8000/api/authors",
     *                  "per_page": 10,
     *                  "to": 6,
     *                  "total": 6
     *              },
     *              "status": "success",
     *              "message": "Authors data retrieved successfully."
     *           }
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
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *    path="/api/authors",
     *    tags={"Author"},
     *    summary="Store Author",
     *    description="Create a new author and returns the created author data.",
     *    security={{"passport":{}}},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      description="Author data",
     *
     *      @OA\JsonContent(
     *        example={
     *          "name": "Budi",
     *          "bio": "Hidup harus dicobain",
     *          "birth_date": "1998-10-10"
     *        }
     *      ),
     *
     *      @OA\Schema(
     *          type="object",
     *          required={"name", "bio", "birth_date"},
     *
     *          @OA\Property(property="name", type="string"),
     *          @OA\Property(property="bio", type="text"),
     *          @OA\Property(property="birth_date", type="date"),
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
     *              "message": "Successfully Store Author.",
     *              "data": {
     *                  "name": "Budi",
     *                  "bio": "Hidup harus dicobain",
     *                  "birth_date": "1998-10-10",
     *                  "created_at": "2024-07-17 09:05:33",
     *                  "updated_at": "2024-07-17 09:05:33"
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
     *                      "name": {
     *                          "Name is required."
     *                      }
     *                  }
     *              },
     *              summary="Name is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-2",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "bio": {
     *                          "Bio is required."
     *                      }
     *                  }
     *              },
     *              summary="Bio is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-3",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "birth_date": {
     *                          "Birth date is required."
     *                      }
     *                  }
     *              },
     *              summary="Birth date is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-4",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "name": {
     *                          "Name has already been taken."
     *                      }
     *                  }
     *              },
     *              summary="Name has already been taken.",
     *          ),
     *          @OA\Examples(
     *              example="error-5",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "birth_date": {
     *                          "Birth date must be valid date."
     *                      }
     *                  }
     *              },
     *              summary="Birth date must be valid date.",
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
     * @OA\Get(
     *    path="/api/authors/{id}",
     *    tags={"Author"},
     *    summary="Detail Author",
     *    description="See detail author.",
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
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(
     *           example={
     *              "status": "success",
     *              "message": "Successfully Show Detail Author.",
     *              "data": {
     *                  "id": 1,
     *                  "name": "Budi",
     *                  "bio": "Hidup harus dicobain",
     *                  "birth_date": "1998-10-10",
     *                  "created_at": "2024-07-17 14:03:43",
     *                  "updated_at": "2024-07-17 14:45:43"
     *              }
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
     *                          "Author ID does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Author ID does not exist.",
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
    public function show()
    {
        //
    }

    /**
     * @OA\Put(
     *    path="/api/authors/{id}",
     *    tags={"Author"},
     *    summary="Update Author",
     *    description="Update author and returns success response.",
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
     *      description="Author data",
     *
     *      @OA\JsonContent(
     *        example={
     *          "name": "Budi",
     *          "bio": "Hidup harus dicobain",
     *          "birth_date": "1998-10-10"
     *        }
     *      ),
     *
     *      @OA\Schema(
     *          type="object",
     *          required={"name", "bio", "birth_date"},
     *
     *          @OA\Property(property="name", type="string"),
     *          @OA\Property(property="bio", type="text"),
     *          @OA\Property(property="birth_date", type="date"),
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
     *              "message": "Successfully Updated Author."
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
     *                          "Author ID does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Author ID does not exist.",
     *          ),
     *          @OA\Examples(
     *              example="error-2",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "name": {
     *                          "Name is required."
     *                      }
     *                  }
     *              },
     *              summary="Name is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-3",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "bio": {
     *                          "Bio is required."
     *                      }
     *                  }
     *              },
     *              summary="Bio is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-4",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "birth_date": {
     *                          "Birth date is required."
     *                      }
     *                  }
     *              },
     *              summary="Birth date is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-5",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "birth_date": {
     *                          "Birth date must be valid date."
     *                      }
     *                  }
     *              },
     *              summary="Birth date must be valid date.",
     *          ),
     *          @OA\Examples(
     *              example="error-6",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "name": {
     *                          "Name has already been taken."
     *                      }
     *                  }
     *              },
     *              summary="Name has already been taken.",
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

    /**
     * @OA\Delete(
     *    path="/api/authors/{id}",
     *    tags={"Author"},
     *    summary="Delete Author",
     *    description="Delete author data.",
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
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(
     *           example={
     *              "status": "success",
     *              "message": "Successfully Deleted Author."
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
     *                          "Author ID does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Author ID does not exist.",
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
    public function destroy()
    {
        //
    }
}
