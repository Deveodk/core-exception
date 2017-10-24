<?php

namespace DeveoDK\Core\Exception\Handlers;

use DeveoDK\Core\Exception\Exceptions\BaseException;
use DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException;
use DeveoDK\Core\Exception\Exceptions\Http\NotFoundException;
use DeveoDK\Core\Exception\Formatters\CoreExceptionFormatter;
use DeveoDK\Core\Exception\Formatters\ExceptionFormatter;
use DeveoDK\Core\Exception\Formatters\ValidationFormatter;
use DeveoDK\Core\Exception\Reporters\ReporterInterface;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DeveoDK\Core\Exception\Exceptions\Validation\ValidationException as CoreValidation;

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
        CoreValidation::class,
    ];

    /** @var string */
    protected $reportedID;

    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if (env('EXCEPTION_HANDLER') === 'laravel') {
            return parent::render($request, $exception);
        }

        return $this->renderFromFormatter($exception);
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
        $config = config('core.exception');
        $reporterClass = $config['reporter'];

        if (!$this->shouldReport($exception)) {
            return parent::report($exception);
        }

        if (class_exists($reporterClass)) {
            /** @var ReporterInterface $reporter */
            $reporter = new $reporterClass();
            $reportedID = $reporter->report($exception);
            $this->reportedID = $reportedID;
        }

        return parent::report($exception);
    }

    /**
     * @param Exception $exception
     * @return JsonResponse
     */
    protected function renderFromFormatter(Exception $exception)
    {
        $this->convertToCoreException($exception);

        $status = 500;

        if ($exception instanceof BaseException) {
            $status = $exception->getStatusCode();
        }

        $errors = [
            'errors' => [],
        ];

        switch ($exception) {
            case $exception instanceof CoreValidation:
                $exceptionFormatter = new ValidationFormatter();
                array_push($errors['errors'], $exceptionFormatter->format($exception, []));
                break;
            case $exception instanceof BaseException:
                $exceptionFormatter = new CoreExceptionFormatter();
                array_push($errors['errors'], $exceptionFormatter->format($exception, []));
                break;
            default:
                $exceptionFormatter = new ExceptionFormatter();
                array_push($errors['errors'], $exceptionFormatter->format($exception, []));
                break;
        }

        $errors['status'] = $status;

        if ($this->reportedID !== null) {
            $errors['case_id'] = $this->reportedID;
        }

        return response()->json($errors, $status);
    }

    /**
     * @param Exception $exception
     * @throws CoreValidation
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    protected function convertToCoreException(Exception $exception)
    {
        switch ($exception) {
            case $exception instanceof NotFoundHttpException:
                throw new NotFoundException();
                break;
            case $exception instanceof ValidationException:
                throw new CoreValidation($exception->validator);
                break;
            case $exception instanceof MethodNotAllowedHttpException:
                throw new MethodNotAllowedException();
                break;
        }
    }

    /**
     * @return string
     */
    public function getReportedID()
    {
        return $this->reportedID;
    }
}
