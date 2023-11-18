<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
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

    public function render($request, Throwable $th)
    {
        if ($th instanceof ModelNotFoundException) {
            $model = Str::kebab(class_basename($th->getModel()));
            $ids = $th->getIds();
            $formattedIds = is_array($ids) ? implode(',', $ids) : $ids;
            if (blank($formattedIds)) $formattedIds = $request->route('id');
            $message =  "$model not found with id: $formattedIds";

            return response()->json(['error' => $message], Response::HTTP_NOT_FOUND);
        }

        if ($th instanceof ValidationException) {
            return response()->json([
                $th->validator->errors()->getMessages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($th instanceof \Throwable) {
            $message = env('APP_DEBUG') ? $th->getMessage() : 'looks_like_something_wrong';
            $trace = env('APP_DEBUG') ? $th->getTrace() : 'internal_server_error';

            return response()->json([
                'error' => $message,
                'trace' => $trace
            ], $th->getCode());
        }

        return response()->json([
            'error' => $th->getMessage(),
            'trace' => $th->getTrace()
        ]);
    }
}
