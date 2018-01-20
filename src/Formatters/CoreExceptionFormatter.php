<?php

namespace DeveoDK\Core\Exception\Formatters;

use DeveoDK\Core\Exception\Exceptions\BaseException;
use DeveoDK\Core\Exception\Exceptions\Validation\ValidationException;

class CoreExceptionFormatter
{
    /**
     * @param BaseException|Exception $exception
     * @param string|null $whoops
     * @return array
     */
    public function format($exception, ?string $whoops)
    {
        $title = __('exceptions.defaultException.title');
        $message = __('exceptions.defaultException.message');
        $code = '0';

        if (method_exists($exception, 'getTitle')) {
            $title = $exception->getTitle();
        }

        if (method_exists($exception, 'getCoreExceptionCode')) {
            $code = $exception->getCoreExceptionCode();
        }

        if (!empty($exception->getMessage())) {
            $message = $exception->getMessage();
        }

        $data = [
            'code'   => $code,
            'title' => $title,
            'detail'   => $message,
        ];

        if (env('APP_DEBUG')) {
            $data = array_merge($data, [
                'exception' => get_class($exception),
                'line'   => $exception->getLine(),
                'file'   => $exception->getFile(),
            ]);
        }

        if ($whoops) {
            $data = array_merge($data, [
               'whoops' => $whoops,
            ]);
        }

        return $data;
    }

    /**
     * Format validation exception
     * @return array
     */
    public function formatValidationException(ValidationException $exception)
    {
        $validationErrors = $exception->getValidator()->errors()->getMessages();

        $errors = [];

        foreach ($validationErrors as $key => $validationError) {
            $error = [
                'code'   => $exception->getCoreExceptionCode(),
                'title' => $key,
                'detail'   => $validationError[0],
            ];

            array_push($errors, $error);
        }

        return $errors;
    }
}
