<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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

        $this->renderable(function (ValidationException $exception) {
            return response()->error($exception->getMessage(), 422);
        });

        $this->renderable(function (NotFoundHttpException $exception) {
            if (is_a($previous = $exception->getPrevious(), ModelNotFoundException::class)) {
                $id = $previous->getIds()[0];

                $message = 'No se encontraron resultados con id ' . $id . '.';
            } else
                $message = 'La ruta a la que intentas acceder no es válida.';

            return response()->error($message, 404);
        });

        $this->renderable(function (AuthenticationException $exception) {

            $message = 'No autenticado.';

            return response()->error($message, 401);
        });

        $this->renderable(function (\Exception $exception) {
            return response()->error($exception->getMessage());
        });
    }
}
