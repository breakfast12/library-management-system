<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedException extends Exception
{
    /**
     * Render an unauthenticated JSON response.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        // Return a JSON response
        return response()->json([
            'status' => 'failed',
            'message' => 'Unauthenticated.',
        ], 401);
    }
}
