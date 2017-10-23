<?php

namespace DeveoDK\Core\Exception\Exceptions\Validation;

use DeveoDK\Core\Exception\Exceptions\BaseException;
use Illuminate\Contracts\Validation\Validator;
use Throwable;

class ValidationException extends BaseException
{
    /**
     * Provides a common error code for CORE exceptions
     * @var string
     */
    const ERROR_CODE = 3004;

    /**
     * The given HTTP status code for the exception
     * @var string
     */
    const HTTP_CODE = 422;

    /** @var Validator */
    protected $validator;

    public function __construct(Validator $validator, $message = "", Throwable $previous = null)
    {
        $this->validator = $validator;
        parent::__construct(self::HTTP_CODE, self::ERROR_CODE, "", $message, $previous);
    }

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * @param Validator $validator
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }
}
