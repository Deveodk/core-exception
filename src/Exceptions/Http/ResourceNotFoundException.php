<?php

namespace DeveoDK\Core\Exception\Exceptions\Http;

use DeveoDK\Core\Exception\Exceptions\BaseException;

class ResourceNotFoundException extends BaseException
{
    /**
     * The given HTTP status code for the exception
     * @var string
     */
    const HTTP_CODE = 404;

    /**
     * ResourceNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::HTTP_CODE);
    }
}
