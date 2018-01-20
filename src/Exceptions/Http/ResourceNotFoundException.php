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
     * @param null|string $bundle
     */
    public function __construct(?string $bundle = null)
    {
        parent::__construct(self::STATUS_CODE, $bundle);
    }
}
