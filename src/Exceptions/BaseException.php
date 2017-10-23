<?php

namespace DeveoDK\Core\Exception\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    /** @var int */
    protected $statusCode;

    /** @var string */
    protected $title;

    /**
     * BaseException constructor.
     * @param string $statusCode
     * @param int $code
     * @param string $title
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($statusCode, $code, $title = "", $message = "", Throwable $previous = null)
    {
        $this->statusCode = $statusCode;
        $this->title = $title;
        parent::__construct($message, $code, $previous);
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
}
