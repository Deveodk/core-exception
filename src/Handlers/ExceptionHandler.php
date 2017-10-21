<?php

namespace DeveoDK\Core\Exception\Handlers;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Validation\ValidationException;

class ExceptionHandler extends Handler
{
    /**
     * A list of the exception types that should not be reported.
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param Exception $exception
     */
    public function renderForConsole($output, Exception $exception)
    {
        parent::renderForConsole($output, $exception);
    }

    /**
     * @param Exception $exception
     * @return mixed
     */
    public function report(Exception $exception)
    {
        return parent::report($exception);
    }
}
