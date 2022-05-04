<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Throwable;

final class AuthorizationExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  AuthorizationException|Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {
        return (new ErrorResponse([
            'message' => $this->getMessage($exception),
        ]))->response()->setStatusCode(Response::HTTP_FORBIDDEN);
    }

    /**
     * @param  Throwable  $exception
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    private function getMessage(Throwable $exception)
    {
        return $exception->getMessage() && $exception->getMessage() !== 'This action is unauthorized.'
            ? $exception->getMessage()
            : __('errors.forbidden');
    }
}
