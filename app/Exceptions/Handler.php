<?php

namespace App\Exceptions;

use App\Exceptions\Handlers\AuthenticationExceptionHandler;
use App\Exceptions\Handlers\AuthorizationExceptionHandler;
use App\Exceptions\Handlers\DefaultHandler;
use App\Exceptions\Handlers\ErrorExceptionHandler;
use App\Exceptions\Handlers\ModelNotFoundExceptionHandler;
use App\Exceptions\Handlers\NotFoundHttpExceptionHandler;
use App\Exceptions\Handlers\OAuthServerExceptionHandler;
use App\Exceptions\Handlers\QueryExceptionHandler;
use App\Exceptions\Handlers\ValidationExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * A list of the errors handlers
     *
     * @var array|string[]
     */
    protected $handlers = [
        ErrorException::class => ErrorExceptionHandler::class,
        ValidationException::class => ValidationExceptionHandler::class,
        OAuthServerException::class => OAuthServerExceptionHandler::class,
        QueryException::class => QueryExceptionHandler::class,
        NotFoundHttpException::class => NotFoundHttpExceptionHandler::class,
        AuthenticationException::class => AuthenticationExceptionHandler::class,
        ModelNotFoundException::class => ModelNotFoundExceptionHandler::class,
        AuthorizationException::class => AuthorizationExceptionHandler::class,
        AccessDeniedHttpException::class => AuthorizationExceptionHandler::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|Response|object|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {

        if (!$this->isApiRoute($request)) {
            return parent::render($request, $exception);
        }


        $className = get_class($exception);
        if (isset($this->handlers[$className])) {
            return (new $this->handlers[$className])->response($request, $exception);
        }
        return (new DefaultHandler)->response($request, $exception);
    }


    /**
     * @param $request
     * @return bool
     */
    private function isApiRoute($request): bool
    {
        return Str::startsWith($request->getRequestUri(), ['/api', 'api']);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if (!$this->isApiRoute($request)) {
            if ($request->expectsJson()) {
                return response()->json(['error' => __('errors.unauthenticated')], 401);
            }
            return redirect()->guest(route('adminLoginShow'));
        }
    }
}
