<?php

namespace DeveoDK\Core\Exception\Exceptions\Http;

use DeveoDK\Core\Exception\Exceptions\BaseException;

class NotFoundException extends BaseException
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
     * NotFoundException constructor.
     * @param string $title
     * @param string $message
     * @param null $previous
     */
    public function __construct($title = null, $message = null, $previous = null)
    {
        $title = ($title) ? $title : __('exceptions.NotFoundException.title');
        $message = ($message) ? $message : __('exceptions.NotFoundException.message');

        parent::__construct(self::HTTP_CODE, self::ERROR_CODE, $title, $message, $previous);
    }
}
