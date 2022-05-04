<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

final class NotFoundHttpExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        $code = $this->checkCode($exception->getStatusCode());

        return (new ErrorResponse([
            'message' => $exception->getMessage() ?: __('errors.not_found'),
        ]))->response()->setStatusCode($code);
    }
}
