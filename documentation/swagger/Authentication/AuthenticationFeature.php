<?php

namespace Documentation\Swagger\Authentication;

use Documentation\Swagger\Swagger;

class AuthenticationFeature extends Swagger
{
    /**
     * @OA\Post(
     *    path="/api/auth/login",
     *    tags={"Authentication"},
     *    summary="Login",
     *
     *    @OA\RequestBody(
     *      required=true,
     *
     *      @OA\JsonContent(
     *        example={
     *          "email": "admin@mailinator.com",
     *          "password": "password"
     *        }
     *      ),
     *
     *      @OA\Schema(
     *          type="object",
     *          required={"email", "password"},
     *
     *          @OA\Property(property="email", type="email"),
     *          @OA\Property(property="password", type="string"),
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
     *              "message": "Successfully Logged In.",
     *              "data": {
     *                  "user" : {
     *                      "name": "Admin",
     *                      "email": "admin@mailinator.com"
     *                  },
     *                  "token_type": "Bearer",
     *                  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDMyNjk4ZTZiYzQxNDMxMDc2MjU0OWU1ZjAzOGEyZDczMjkxNjYwNzRjMWRjOTRlN2VlNjljYTkwMGNmN2I5MjcwZjdmOWQ1ZjFlMjY1YWYiLCJpYXQiOjE3MjA3ODQyMzUsIm5iZiI6MTcyMDc4NDIzNSwiZXhwIjoxNzUyMzIwMjM1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.WGcA4rCVldxJkrnxizz19nK5s8bJ2TI2fImOwx0S2s9lQRQwjYm5zFavzJFuKOJlJsguYvJwVlGLDYQp2K4CY7XbLOwVoS8hmqJs6eBOx2RQk65D6CzcyTxADmV9yfHdpsrwtrcM8WjqNGJgHErBxhNTL3JRjQTa8svsNHzkZGZYPthaz3KqCiW8P-PMU515S0mbTmfjTlWloV3LKYuIunWEVOABQxHuRUMbbPZAKvpFEOf5Z5JL_vif98epR2iZIHKWYwiz6FMQbf2wX5Zxfg7M9IMCL2ePvydomuZnrQWYx36BwtlTrAwZZv5mEyXqsOAj6xFPaI5lnHIuFdjSXH2utrZUrjqZ47_-W1_5i1GLjufOFqtqR2OR1Eg21kYr0OsPOdNV7Xk0irXxzRtghUmRKoC-Xg_ibKjMWdhQzbEMACWMEWuG51B6JUkqJWgFDAxGilTmH-nKM3KIhlVR6xpg7AkFHu7ICrlVV0fXraIagdn5gGKLWS5HZ6-QCERstj0duIYTcOanhtZzFCIkmzYqdAWvLhVdsz7TtuOv7g03XdbwuzkkKSk9F4mUudJyrZZn8LXAuGDmLPWhpH7OyvsicZxQLeORHjrgGpJoxdd1x7HzrHR55tHqSqrd_Lxakabsqp_KLVF10zj4_TEk99jS9cGFfAPKnc5Agsa_j6I"
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
     *                      "email" : {
     *                          "Email address is required."
     *                      }
     *                  }
     *              },
     *              summary="Email address is required.",
     *          ),
     *          @OA\Examples(
     *              example="error-2",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "password": {
     *                          "Please enter your password."
     *                      }
     *                  }
     *              },
     *              summary="Please enter your password.",
     *          ),
     *          @OA\Examples(
     *              example="error-3",
     *              value={
     *                  "status": "error",
     *                  "message": {
     *                      "email": {
     *                          "Please provide a valid email address."
     *                      }
     *                  }
     *              },
     *              summary="Please provide a valid email address.",
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
     *                  "status": "failed",
     *                  "message": "Unauthorized"
     *              },
     *              summary="Unauthorized",
     *          ),
     *        ),
     *     ),
     * )
     */
    public function login()
    {
        //
    }

    /**
     * @OA\Post(
     *    path="/api/auth/logout",
     *    tags={"Authentication"},
     *    summary="Logout",
     *    security={{"passport":{}}},
     *
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *
     *        @OA\JsonContent(
     *           example={
     *                {
     *                  "status": "success",
     *                  "message": "Successfully logged out.",
     *               }
     *           }
     *        ),
     *    ),
     *
     *    @OA\Response(
     *        response=401,
     *        description="Unauthorized",
     *
     *        @OA\JsonContent(
     *
     *          @OA\Examples(
     *              example="error-1",
     *              value={
     *                  "status": "failed",
     *                  "message": "Unauthenticated."
     *              },
     *              summary="Unauthenticated.",
     *          ),
     *        ),
     *     ),
     * )
     */
    public function logout()
    {
        //
    }
}
