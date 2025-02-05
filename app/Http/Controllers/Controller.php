<?php

namespace App\Http\Controllers;

use App\Supports\HandleJsonResponses;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Exception\FatalErrorException;
use Throwable;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, HandleJsonResponses;

    /**
     * @param array $data
     * @return JsonResponse
     */
    protected function response(array $data): JsonResponse
    {
        return response()->json($data);
    }

    /**
     * Make API call with exception handling.
     * This allows to gracefully catch all possible exceptions and handle them properly.
     *
     * @param $callback
     *
     * @return mixed
     */
    protected function withErrorHandling($callback): mixed
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            Log::debug($e);
            return $this->message(__('An unexpected error occurred. Please try again later.'))
                ->respondBadRequest();
        }
    }

    /**
     * @param $callback
     * @return mixed
     */
    protected function withMessageErrorHandling($callback): mixed
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            Log::debug($e);
            return $this->message($e->getMessage())
                ->respondBadRequest();
        }
    }

    /**
     * Use when has custom exception
     *
     * @param $callback
     * @return mixed
     */
    protected function withOverlapErrorHandling($callback): mixed
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            Log::debug($e);
            return $this->handleComponentError($e);
        }
    }

    /**
     * @param $e
     * @param $message
     * @param int $status
     * @return mixed
     */
    protected function handleComponentError($e, $message = null, int $status = 400): mixed
    {
        try {
            if ($e instanceof Throwable && !$e instanceof Exception) {
                $e = new FatalErrorException($e);
            }

            if (method_exists($e, 'getStatusCode') && $e->getStatusCode() !== null) {
                $status = $e->getStatusCode();
            }

            app(ExceptionHandler::class)->report($e);
            $message = $message ?? $e->getMessage();

            return app(ExceptionHandler::class)->respondError([], $message, $status);
        } catch (Throwable $e) {
            Log::debug($e);
            return $this->message(__('An unexpected error occurred. Please try again later.'))
                ->respondBadRequest();
        }
    }

    /**
     * @param $callback
     * @return JsonResponse
     * @throws Throwable
     */
    protected function withTransactionErrorHandling($callback): JsonResponse
    {
        DB::beginTransaction();

        try {
            $result = $callback();
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e);
            return $this->message($e->getMessage())
                ->respondBadRequest();
        }
    }
}
