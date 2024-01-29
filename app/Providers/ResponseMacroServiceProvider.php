<?php

namespace App\Providers;

use App\Dto\Base\ResponseDto;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Response::macro('success', function (array $data = null, string $message = null) {
            if (!$message)
                $message = 'Solicitud completada con éxito.';

            $response = new ResponseDto();

            $response->fill([
                'success' => 1,
                'status_code' => 200,
                'message' => $message,
                'data' => $data
            ]);

            return Response::json($response->toArray());
        });

        Response::macro('error', function (string $message = null, int $statusCode = 500) {
            if (!$message)
                $message = 'Ocurrió un problema al procesar la solicitud.';

            $response = new ResponseDto();

            $response->fill([
                'success' => 0,
                'status_code' => $statusCode,
                'message' => $message
            ]);

            return Response::json($response->toArray(), $statusCode);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
