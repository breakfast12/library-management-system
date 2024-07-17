<?php

namespace Documentation\Swagger\Author;

use Documentation\Swagger\Swagger;

class AuthorFeature extends Swagger
{
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
     *        response=200,
     *        description="Success",
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
     *                      "name" : {
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
}
