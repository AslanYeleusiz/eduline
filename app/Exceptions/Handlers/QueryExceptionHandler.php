<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Throwable;

final class QueryExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        return (new ErrorResponse([
            'message' => mb_convert_encoding($exception->getMessage(), 'utf8', 'utf8'),
        ]))->response()->setStatusCode($this->checkCode($exception->getCode()));
    }
}
