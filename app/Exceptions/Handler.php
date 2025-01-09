<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
   // public function render($request, Throwable $exception)
   //  {
   //      if ($exception instanceof NotFoundHttpException) {
   //          if ($request->wantsJson()) {
   //              return response()->json(['error' => 'Not Found'], 404);
   //          }
   //          return response()->view('errors.404', [], 404);
   //      } elseif ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
   //          return response()->view('errors.403', [], 403);
   //      } elseif ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
   //          $statusCode = $exception->getStatusCode();
   //          $view = "errors.{$statusCode}";

   //          if (view()->exists($view)) {
   //              return response()->view($view, [], $statusCode);
   //          }
   //      }

   //      return response()->view('errors.500', [], 500);
   //  }
}