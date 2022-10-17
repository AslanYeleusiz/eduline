<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

final class ValidationExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        return (new ErrorResponse([
            'message' => __('errors.given_data_invalid'),
            'errors'  => $exception->errors(),
        ]))->response()->setStatusCode(200);
    }
}
