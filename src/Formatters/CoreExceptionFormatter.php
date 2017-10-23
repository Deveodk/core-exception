<?php

namespace DeveoDK\Core\Exception\Formatters;

use DeveoDK\Core\Exception\Exceptions\BaseException;

class CoreExceptionFormatter extends BaseFormatter
{
    /**
     * @param BaseException $exception
     * @param array $reporterResponses
     * @return array
     */
    public function format(BaseException $exception, array $reporterResponses)
    {
        $data = [
            'code'   => $exception->getCode(),
            'title' => $exception->getTitle(),
            'detail'   => $exception->getMessage(),
        ];

        if (env('APP_DEBUG')) {
            $data = [
                'code'   => $exception->getCode(),
                'title' => $exception->getTitle(),
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
