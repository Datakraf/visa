<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Session\TokenMismatchException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return $this->unauthorized($request, $exception);
        }
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        if ($exception instanceof InvalidSignatureException) {
            return $this->invalidUrlSignature($request, $exception);
        }
        if ($exception instanceof TokenMismatchException) {
            return $this->pageExpired($request, $exception);
        }

        return parent::render($request, $exception);
    }

    public function noRole($request, Exception $exception)
    {
        if (!Auth::user()->hasRole(['Admin', 'User'])) {
            Auth::logout();
            return redirect('login');
        }
    }

    private function unauthorized($request, Exception $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('login'));

        toast('You\'re not allowed to perform the action', 'error', 'top');        
        return back();
    }

    public function invalidUrlSignature($request, Exception $exception)
    {
        toast('Security token mismatched. You\'re not allowed to perform the operation','error','top');        
        return back();
    }

    public function pageExpired($request, Exception $exception)
    {
        toast('Your session has expired, please login again','error','top');          
        return redirect('login');
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'staff':
                $login = 'staff.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
