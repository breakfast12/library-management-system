<?php

namespace Documentation\Swagger\Book;

use Documentation\Swagger\Swagger;

class BookFeature extends Swagger
{
    /**
     * @OA\Get(
     *    path="/api/books",
     *    tags={"Book"},
     *    summary="List books",
     *    description="Get list books and can search, sorting and filter.",
     *    security={{"passport":{}}},
     *
     *    @OA\Parameter(
     *         name="search",
     *         in="query",
     *
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         description="Search term for title, description and author name"
     *    ),
     *
     *    @OA\Parameter(
     *        name="publish_date_from",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string",
     *            format="date"
     *        ),
     *        description="Filter book publish after this date"
     *    ),
     *
     *    @OA\Parameter(
     *        name="publish_date_to",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string",
     *            format="date"
     *        ),
     *        description="Filter book publish before this date"
     *    ),
     *
     *    @OA\Parameter(
     *        name="order_by",
     *        in="query",
     *
     *        @OA\Schema(
     *            type="string"
     *        ),
     *        description="Column to order by (title, description, publish_date, author_name, created_at, updated_at)"
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
     *                      "title": "Melangkah",
     *                      "description": "Melangkah bertemakan tentang petualangan di Indonesia",
     *                      "publish_date": "2020-03-22",
     *                      "author": {
     *                          "id": 1,
     *                          "name": "Sylvester Robert"
     *                      },
     *                      "created_at": "2024-07-19 11:24:20",
     *                      "updated_at": "2024-07-19 11:24:20"
     *                  },
     *                  {
     *                      "id": 2,
     *                      "title": "Wingit",
     *                      "description": "Wingit menceritakan kisah-kisah mistis atau horor",
     *                      "publish_date": "2020-12-15",
     *                      "author": {
     *                          "id": 2,
     *                          "name": "Vanda Dirkje"
     *                      },
     *                      "created_at": "2024-07-19 11:19:20",
     *                      "updated_at": "2024-07-19 11:19:20"
     *                  },
     *                  {
     *                      "id": 3,
     *                      "title": "Almond",
     *                      "description": "Almond adalah novel yang memberi harapan kepada orang seperti saya yang percaya bahwa hati dapat mengendalikan kepala.",
     *                      "publish_date": "2019-03-31",
     *                      "author": {
     *                          "id": 3,
     *                          "name": "Cathrine Dino"
     *                      },
     *                      "created_at": "2024-07-19 11:14:20",
     *                      "updated_at": "2024-07-19 11:14:20"
     *                  },
     *                  {
     *                      "id": 4,
     *                      "title": "Di Hadapan Rahasia",
     *                      "description": "Kumpulan puisi yang meromantisasi rindu, sebuah peratapan dalam penantian, sampai memelihara harapan yang sepi dalam satu jiwa",
     *                      "publish_date": "2020-01-19",
     *                      "author": {
     *                           "id": 4,
     *                           "name": "Murad Hilaire"
     *                      },
     *                      "created_at": "2024-07-19 11:09:20",
     *                      "updated_at": "2024-07-19 11:09:20"
     *                  },
     *                  {
     *                      "id": 5,
     *                      "title": "Melihat Pengarang Tidak Bekerja",
     *                      "description": "Serupa perbuatan baik lain, menulis itu selalu sulit ditunaikan. Dihadapkan ragam rintangan yang coba menghadang",
     *                      "publish_date": "2022-05-22",
     *                      "author": {
     *                          "id": 5,
     *                           "name": "Emmy Jonna"
     *                      },
     *                      "created_at": "2024-07-19 11:04:20",
     *                      "updated_at": "2024-07-19 11:04:20"
     *                  },
     *                  {
     *                      "id": 6,
     *                      "title": "Perburuan Piring Emas",
     *                      "description": "Di tengah sebuah pesta topeng yang digelar oleh Stuyvesant Randolph, seorang jutawan pemilik Seven Oaks, terjadi sebuah pencurian yang sangat berani",
     *                      "publish_date": "2022-03-21",
     *                      "author": {
     *                          "id": 6,
     *                          "name": "Surya Admetos"
     *                      },
     *                      "created_at": "2024-07-19 10:59:20",
     *                      "updated_at": "2024-07-19 10:59:20"
     *                  },
     *                  {
     *                      "id": 7,
     *                      "title": "Arah Musim",
     *                      "description": "Seperti musim yang selalu berganti,isi dari buku ini juga mengingatkan manusia dengan segala perannya.",
     *                      "publish_date": "2019-10-13",
     *                      "author": {
     *                          "id": 7,
     *                          "name": "Eino Kondwani"
     *                      },
     *                      "created_at": "2024-07-19 10:54:20",
     *                      "updated_at": "2024-07-19 10:54:20"
     *                  },
     *                  {
     *                      "id": 8,
     *                      "title": "Today I Miss You",
     *                      "description": "Dari yang tak biasa untuk bertegur sapa, menjadi biasa. Sampai akhirnya ada rasa gugup yang hinggap di dalam dada saat berjumpa.",
     *                      "publish_date": "2019-12-22",
     *                      "author": {
     *                          "id": 8,
     *                          "name": "Siana Dana"
     *                      },
     *                      "created_at": "2024-07-19 10:49:20",
     *                      "updated_at": "2024-07-19 10:49:20"
     *                  },
     *                  {
     *                      "id": 9,
     *                      "title": "Tanah Putih",
     *                      "description": "Kau telah membuatku kembali percaya bahwa cinta adalah sebuah kemerdekaan.",
     *                      "publish_date": "2019-08-31",
     *                      "author": {
     *                          "id": 1,
     *                          "name": "Sylvester Robert"
     *                      },
     *                      "created_at": "2024-07-19 10:44:20",
     *                      "updated_at": "2024-07-19 10:44:20"
     *                  },
     *                  {
     *                      "id": 10,
     *                      "title": "Pertanda",
     *                      "description": "Pertanda adalah kumpulan kisah nyata tentang tanda datangnya kematian seseorang.",
     *                      "publish_date": "2019-09-02",
     *                      "author": {
     *                          "id": 2,
     *                          "name": "Vanda Dirkje"
     *                      },
     *                      "created_at": "2024-07-19 10:39:20",
     *                      "updated_at": "2024-07-19 10:39:20"
     *                  }
     *              },
     *              "links": {
     *                  "first": "http://127.0.0.1:8000/api/books?page=1",
     *                  "last": "http://127.0.0.1:8000/api/books?page=2",
     *                  "prev": null,
     *                  "next": "http://127.0.0.1:8000/api/books?page=2"
     *              },
     *              "meta": {
     *                  "current_page": 1,
     *                  "from": 1,
     *                  "last_page": 2,
     *                  "links": {
     *                      {
     *                          "url": null,
     *                          "label": "&laquo; Previous",
     *                          "active": false
     *                      },
     *                      {
     *                          "url": "http://127.0.0.1:8000/api/books?page=1",
     *                          "label": "1",
     *                          "active": true
     *                      },
     *                      {
     *                          "url": "http://127.0.0.1:8000/api/books?page=2",
     *                          "label": "2",
     *                          "active": false
     *                      },
     *                      {
     *                          "url": "http://127.0.0.1:8000/api/books?page=2",
     *                          "label": "Next &raquo;",
     *                          "active": false
     *                      }
     *                  },
     *                  "path": "http://127.0.0.1:8000/api/books",
     *                  "per_page": 10,
     *                  "to": 10,
     *                  "total": 12
     *              },
     *              "status": "success",
     *              "message": "Books data retrieved successfully."
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
     * @OA\Get(
     *    path="/api/books/{id}",
     *    tags={"Book"},
     *    summary="Detail Book With Author",
     *    description="See detail book with author.",
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
     *              "message": "Successfully Show Detail Book.",
     *              "data": {
     *                  "id": 1,
     *                  "title": "Wingit",
     *                  "description": "Wingit menceritakan kisah-kisah mistis atau horor",
     *                  "publish_date": "2020-12-15",
     *                  "author": {
     *                      "id": 2,
     *                      "name": "Vanda Dirkje"
     *                  },
     *                  "created_at": "2024-07-19 06:18:08",
     *                  "updated_at": "2024-07-19 06:18:08"
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
     *                          "Book ID does not exist."
     *                      }
     *                  }
     *              },
     *              summary="Book ID does not exist.",
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

    /**
     * @OA\Delete(
     *    path="/api/books/{id}",
     *    tags={"Book"},
     *    summary="Delete Book",
     *    description="Delete book data.",
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
     *              "message": "Successfully Deleted Book."
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
