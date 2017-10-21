<?php

namespace DeveoDK\Core\Exception\Reporters;

use Exception;

interface ReporterInterface
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    public function report(Exception $exception);
}
