<?php

namespace DeveoDK\Core\Exception\Handlers;

use DeveoDK\Core\Exception\Exceptions\BaseException;
use DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException;
use DeveoDK\Core\Exception\Exceptions\Http\NotFoundException;
use DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException;
use DeveoDK\Core\Exception\Exceptions\Http\ToManyRequestsException;
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
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DeveoDK\Core\Exception\Exceptions\Validation\ValidationException as CoreValidation;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

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
     * @throws CoreValidation
     * @throws MethodNotAllowedException
     * @throws ResourceNotFoundException
     * @throws ToManyRequestsException
     */
    public function render($request, Exception $exception)
    {
        if (config('core.exception.exception_handler') === 'laravel') {
            return parent::render($request, $exception);
        }

        $whoops = null;

        if (config('core.exceptions.exception_show_whoops')) {
            $whoops = $this->convertExceptionToResponse($exception)->getContent();
        }

        return $this->renderFromFormatter($exception, $whoops);
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
     * @param Exception|BaseException $exception
     * @return mixed
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        $config = config('core.exception');
        $reporterClass = $config['reporter'];
        $severity = null;

        if (!$this->shouldReport($exception)) {
            return parent::report($exception);
        }

        if (method_exists($exception, 'getSeverity')) {
            $severity = $exception->getSeverity();
        }

        if (!$config['exception_report_everything']) {
            if ($severity === 'info') {
                return null;
            }
        }

        if (class_exists($reporterClass)) {
            /** @var ReporterInterface $reporter */
            $reporter = new $reporterClass();
            $reportedID = $reporter->report($exception, $severity);
            $this->reportedID = $reportedID;
        }

        return parent::report($exception);
    }

    /**
     * @param Exception $exception
     * @param string|null $whoops
     * @return JsonResponse
     * @throws CoreValidation
     * @throws MethodNotAllowedException
     * @throws ResourceNotFoundException
     * @throws ToManyRequestsException
     */
    protected function renderFromFormatter(Exception $exception, ?string $whoops = null)
    {
        $this->convertToCoreException($exception);

        $status = 500;

        if ($exception instanceof BaseException) {
            $status = $exception->getStatusCode();
        }

        $errors = [
            'errors' => [],
        ];

        $exceptionFormatter = new CoreExceptionFormatter();

        switch ($exception) {
            case $exception instanceof CoreValidation:
                array_push($errors['errors'], $exceptionFormatter->formatValidationException($exception));
                break;
            case $exception instanceof BaseException:
                array_push($errors['errors'], $exceptionFormatter->format($exception, $whoops));
                break;
            default:
                array_push($errors['errors'], $exceptionFormatter->format($exception, $whoops));
                break;
        }

        $errors['status'] = $status;

        if ($this->reportedID !== null) {
            $errors['case_id'] = $this->reportedID;
        }

        return response()->json($errors, $status);
    }

    /**
     * Convert symfony and laravel exceptions
     * into core exceptions.
     *
     * @param Exception $exception
     * @throws CoreValidation
     * @throws MethodNotAllowedException
     * @throws ToManyRequestsException
     * @throws ResourceNotFoundException
     */
    protected function convertToCoreException(Exception $exception)
    {
        switch ($exception) {
            case $exception instanceof NotFoundHttpException:
                throw new ResourceNotFoundException();
                break;
            case $exception instanceof ValidationException:
                throw new CoreValidation($exception->validator);
                break;
            case $exception instanceof TooManyRequestsHttpException:
                throw new ToManyRequestsException();
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
