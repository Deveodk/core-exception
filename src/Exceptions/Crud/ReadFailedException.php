<?php

namespace DeveoDK\Core\Exception\Exceptions\Http;

use DeveoDK\Core\Exception\Exceptions\BaseException;

class ReadFailedException extends BaseException
{
    /**
     * Provides a common error code for CORE exceptions
     * @var string
     */
    const ERROR_CODE = 3002;

    /**
     * The given HTTP status code for the exception
     * @var string
     */
    const HTTP_CODE = 404;

    /**
     * ReadFailed constructor.
     * @param integer $statusCode
     * @param integer $code
     * @param string $title
     * @param string $message
     * @param null $previous
     */
    public function __construct($statusCode = null, $code = null, $title = null, $message = null, $previous = null)
    {
        $statusCode = ($statusCode) ? $statusCode : self::HTTP_CODE;
        $code = ($code) ? $code : self::ERROR_CODE;
        $title = ($title) ? $title : __('exceptions.ReadFailedException.title');
        $message = ($message) ? $message : __('exceptions.ReadFailedException.message');

        parent::__construct($statusCode, $code, $title, $message, $previous);
    }
}
