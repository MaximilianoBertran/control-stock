<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler {

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception) {
        parent::report($exception);
    }

    /**
     * Get the default context variables for logging.
     *
     * @return array
     */
    protected function context() {

        try {
            $context = array_filter([
                'url' => request()->fullUrl(),
                'input' => request()->except(['password', 'password_confirmation']),
            ]);
        } catch (Throwable $e) {
            $context = [];
        }
        return array_merge($context, parent::context());
    }

    /**
     * Get the view used to render HTTP exceptions.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface  $e
     * @return string
     */
    protected function getHttpExceptionView(HttpExceptionInterface $e) {
        if (Str::is('backend/*', request()->path())) {
            if (view()->exists("backend.errors.{$e->getStatusCode()}")) {
                return "backend.errors.{$e->getStatusCode()}";
            }
            return "backend.errors.generic";
        } else {
            if (view()->exists("frontend.errors.{$e->getStatusCode()}")) {
                return "frontend.errors.{$e->getStatusCode()}";
            }
            return "frontend.errors.generic";
        }
    }

}
