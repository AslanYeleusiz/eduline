<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Illuminate\Http\Response;
use Throwable;

final class OAuthServerExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        return (new ErrorResponse([
            'message' => __('errors.passport.invalid_grant'),
        ]))->response()->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }
}
