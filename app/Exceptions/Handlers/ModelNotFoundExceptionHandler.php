<?php

namespace App\Exceptions\Handlers;

use App\Http\Resources\V1\Errors\ErrorResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Throwable;

final class ModelNotFoundExceptionHandler extends Handler
{
    /**
     * @param $request
     * @param  ModelNotFoundException|Throwable  $exception
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function response($request, Throwable $exception)
    {


//        if(! empty($exception->getIds())) {
//            \Log::info('$message[id ');
//            $message['id'] = $exception->getIds()[0];
//        } else {
//            \Log::info('$message[id ');
//        }
        return (new ErrorResponse([
            'message' => __('errors.model_not_found', [
                'model' => __('models.'.Str::snake(Str::afterLast($exception->getModel(), '\\'))),
            ]),
        ]))->response()->setStatusCode(Response::HTTP_NOT_FOUND);
//        return (new ErrorResponse([
//            'message' => __('errors.model_not_found'),
//        ]))->response()->setStatusCode(Response::HTTP_NOT_FOUND);
//        return (new ErrorResponse([
//            'message' => __('errors.model_not_found', $message),
//        ]))->response()->setStatusCode(Response::HTTP_NOT_FOUND);
    }
}
