<?php

namespace DeveoDK\Core\Exception\Reporters;

use Exception;

interface ReporterInterface
{
    /**
     * This is the report method. This will be called when a new exception happens
     * It must return either null or a string containing the ID of the report
     * @param Exception $exception
     * @param string|null $severity
     * @return string|null
     */
    public function report(Exception $exception, ?string $severity);
}
