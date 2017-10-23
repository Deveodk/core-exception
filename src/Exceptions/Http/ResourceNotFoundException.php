<?php

namespace DeveoDK\Core\Exception\Exceptions\Http;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResourceNotFoundException extends HttpException
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
     * MethodNotAllowedException constructor.
     * @param null $message
     * @param Exception|null $previous
     * @param array $headers
     */
    public function __construct($message = null, \Exception $previous = null, array $headers = array())
    {
        parent::__construct(self::HTTP_CODE, $message, $previous, $headers, self::ERROR_CODE);
    }
}
