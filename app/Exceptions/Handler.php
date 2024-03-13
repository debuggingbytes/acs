<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Mail;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

//     public function report(Throwable $exception)
// {
//     if ($this->shouldReport($exception)) {
//         // The exception should be reported, so send an email
//         Mail::raw(
//             "Exception Details:\n\n" .
//             "Message: " . $exception->getMessage() . "\n" .
//             "File: " . $exception->getFile() . "\n" .
//             "Line: " . $exception->getLine() . "\n" .
//             "Trace: " . $exception->getTraceAsString(),
//             function ($message) {
//                 $message->to('errors@albertacraneservice.com');
//                 $message->subject('An exception was thrown');
//             }
//         );
//     }

//     parent::report($exception);
// }
}
