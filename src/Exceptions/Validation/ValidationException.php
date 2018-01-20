<?php

namespace DeveoDK\Core\Exception\Exceptions\Validation;

use DeveoDK\Core\Exception\Exceptions\BaseException;
use Illuminate\Contracts\Validation\Validator;
use Throwable;

class ValidationException extends BaseException
{
    /**
     * The given HTTP status code for the exception
     * @var string
     */
    const HTTP_CODE = 422;

    /** @var Validator */
    protected $validator;

    /**
     * ValidationException constructor.
     * @param Validator $validator
     */
    public function __construct(?Validator $validator = null)
    {
        $this->validator = $validator;
        parent::__construct(self::HTTP_CODE);
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
