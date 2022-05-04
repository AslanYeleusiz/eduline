<?php

namespace App\Exceptions\Handlers;

use Illuminate\Http\Response;
use Throwable;

abstract class Handler
{
    abstract public function response($request, Throwable $exception);

    /**
     * @param $code
     * @return int
     */
    protected function checkCode($code): int
    {
        return is_int($code) && $code >= 300 && $code < 600
            ? $code
            : Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
