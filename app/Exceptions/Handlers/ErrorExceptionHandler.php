<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Throwable;

final class ErrorExceptionHandler extends Handler
{

    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        $code = $this->checkCode($exception->getCode());
        return (new ErrorResponse([
            'message' => $exception->getMessage(),
            'errors'  => $exception->errors(),
        ]))->response()->setStatusCode($code);
    }
}
