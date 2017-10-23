<?php

namespace DeveoDK\Core\Exception\Formatters;

use DeveoDK\Core\Exception\Exceptions\Validation\ValidationException;

class ValidationFormatter extends BaseFormatter
{
    /**
     * @param ValidationException $exception
     * @param array $reporterResponses
     * @return array
     */
    public function format(ValidationException $exception, array $reporterResponses)
    {
        $validationErrors = $exception->getValidator()->errors()->getMessages();

        $errors = [];

        foreach ($validationErrors as $key => $validationError) {
            $error = [
                'code'   => $exception->getCode(),
                'title' => $key,
                'detail'   => $validationError[0],
            ];

            array_push($errors, $error);
        }

        return $errors;
    }
}
