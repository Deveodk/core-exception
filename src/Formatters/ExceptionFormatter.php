<?php

namespace DeveoDK\Core\Exception\Formatters;

use Exception;

class ExceptionFormatter extends BaseFormatter
{
    /**
     * @param Exception $exception
     * @param array $reporterResponses
     * @return array
     */
    public function format(Exception $exception, array $reporterResponses)
    {
        $data = [
            'code'   => $exception->getCode(),
            'title' => __('exceptions.ServerException.title'),
            'detail'   => __('exceptions.ServerException.message'),
        ];

        if (env('APP_DEBUG')) {
            $data = [
                'code'   => $exception->getCode(),
                'title' => __('exceptions.ServerException.title'),
                'detail'   => $exception->getMessage(),
                'line'   => $exception->getLine(),
                'file'   => $exception->getFile(),
                'exception' => get_class($exception),
                'trace' => $exception->getTrace(),
            ];
        }

        return $data;
    }
}
