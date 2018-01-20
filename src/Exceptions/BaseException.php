<?php

namespace DeveoDK\Core\Exception\Exceptions;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{
    /**
     * Core exception title
     * This is variable depending on the
     * Exception that have been thrown
     *
     * @var string
     */
    protected $title;

    /**
     * Core exception message
     * This is variable depending on the
     * Exception that have been thrown
     *
     * @var string
     */
    protected $message;

    /**
     * PHP Core exception code
     * This is used to qualify which errors
     * Are CORE exceptions.
     *
     * @var int
     */
    private $phpExceptionCode = 3400;

    /**
     * Core exception code
     * This is used to track which type
     * of errors get thrown and for support purposes.
     *
     * @var string
     */
    protected $coreExceptionCode;

    /**
     * Core exception bundle
     * This is used to look for exception
     * Translation so we can humanize exception.
     *
     * @var string
     */
    protected $bundle;

    /**
     * Core exception status code,
     * Used for HTTP status.
     *
     * @var int
     */
    protected $statusCode;

    /**
     * Core exception severity
     * Is used for tracking
     *
     * @var string|null
     */
    protected $severity;

    /**
     * BaseException constructor.
     * @param int $statusCode
     * @param string $bundle
     * @param string $title
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct(
        int $statusCode = 500,
        string $bundle = '',
        ?string $title = null,
        ?string $message = null,
        ?string $severity = null,
        Throwable $previous = null
    ) {
        $this->bundle = $bundle;
        $this->statusCode = $statusCode;
        $this->title = $this->parseTitle($title);
        $this->message = $this->parseMessage($message);
        $this->coreExceptionCode = $this->parseCoreExceptionCode();
        $this->severity = $this->parseSeverity($severity);

        parent::__construct($this->message, $this->phpExceptionCode, $previous);
    }

    /**
     * Parse severity options
     * debug (the least serious)
     * info
     * warning
     * error
     * fatal (the most serious)
     *
     * @param null|string $severity
     * @return string
     */
    private function parseSeverity(?string $severity)
    {
        if (is_null($severity)) {
            return "info";
        }

        $severityOptions = [
            'debug',
            'info',
            'warning',
            'error',
            'fatal'
        ];

        if (in_array($severity, $severityOptions)) {
            return $severity;
        }

        return null;
    }

    /**
     * @param null|string $message
     * @return array|null|string
     */
    private function parseMessage(?string $message)
    {
        if (!is_null($message)) {
            return $message;
        }

        $message = $this->parseTranslation('message');

        if (is_null($message)) {
            return __('exceptions.defaultException.message');
        }

        return $message;
    }

    /**
     * @param null|string $title
     * @return array|null|string
     */
    private function parseTitle(?string $title)
    {
        if (!is_null($title)) {
            return $title;
        }

        $title = $this->parseTranslation('title');

        if (is_null($title)) {
            return __('exceptions.defaultException.title');
        }

        return $title;
    }

    /**
     * @param string $key
     * @return array|null|string
     */
    private function parseTranslation(string $key)
    {
        $class = get_called_class();

        $bundleAppend = 'exceptions';

        if ($this->bundle !== '') {
            $bundleAppend = $this->bundle . ':exceptions';
        }

        $searchable = sprintf(
            '%s.%s.%s',
            $bundleAppend,
            $class,
            $key
        );

        $result = __($searchable);

        if ($result === $searchable) {
            return null;
        }

        return $result;
    }

    /**
     * @return int|null|string
     */
    private function parseCoreExceptionCode()
    {
        $config = config('core.exception');

        $errorCodes = $config['error_codes'];

        return $this->findExceptionCode($errorCodes);
    }

    /**
     * @param array $exceptions
     * @return int|null|string
     */
    private function findExceptionCode(array $exceptions)
    {
        foreach ($exceptions as $key => $exception) {
            // If is array find value
            if (!is_array($exception)) {
                if ($exception === get_called_class()) {
                    return $key;
                }

                // When not array we found.
                continue;
            }

            $match = $this->findExceptionCode($exception);

            // Found the key
            if (!is_null($match)) {
                return $match;
            }
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getCoreExceptionCode(): string
    {
        return $this->coreExceptionCode;
    }

    /**
     * @param string $coreExceptionCode
     */
    public function setCoreExceptionCode(string $coreExceptionCode): void
    {
        $this->coreExceptionCode = $coreExceptionCode;
    }

    /**
     * @return null|string
     */
    public function getSeverity(): string
    {
        return $this->severity;
    }

    /**
     * @param null|string $severity
     */
    public function setSeverity(string $severity)
    {
        $this->severity = $severity;
    }
}
