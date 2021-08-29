<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use App\Http\Traits\Response;
use Throwable;

class Handler extends ExceptionHandler
{

    use Response;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */

    protected function unauthenticated($request, AuthenticationException $exception) 
    {
        if ($request->expectsJson()) {
            return $this->sendError(__('auth.unauthorized'),'',401);
        }
    }

    
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e){
            $message = __('common.not_found' , ['resouce' => 'Route']);
            if($e->getPrevious() instanceof ModelNotFoundException){    
                $message =  __('common.not_found' , ['resouce' => $e->getPrevious()->getModel()]);
            }
            return $this->sendError($message,'',404);
        });
    }
}
