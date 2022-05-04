<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Illuminate\Http\Response;
use Throwable;

final class AuthenticationExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        return (new ErrorResponse([
            'message' => __('errors.unauthenticated'),
        ]))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }
}
