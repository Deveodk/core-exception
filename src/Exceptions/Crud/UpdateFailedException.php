<?php

namespace DeveoDK\Core\Exception\Exceptions\Crud;

use DeveoDK\Core\Exception\Exceptions\BaseException;

class UpdateFailedException extends BaseException
{
    /**
     * The given HTTP status code for the exception
     * @var string
     */
    const STATUS_CODE = 404;

    /**
     * UpdateFailed constructor.
     */
    public function __construct()
    {
        parent::__construct(self::STATUS_CODE);
    }
}
