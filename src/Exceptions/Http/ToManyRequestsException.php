<?php

namespace DeveoDK\Core\Exception\Exceptions\Http;

use DeveoDK\Core\Exception\Exceptions\BaseException;

class ToManyRequestsException extends BaseException
{
    /**
     * The given HTTP status code for the exception
     * @var string
     */
    const STATUS_CODE = 429;

    /**
     * ToManyRequestsException constructor.
     * @param null|string $bundle
     */
    public function __construct(?string $bundle = null)
    {
        parent::__construct(self::STATUS_CODE, $bundle);
    }
}
