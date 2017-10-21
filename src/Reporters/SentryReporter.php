<?php

namespace DeveoDK\Core\Exception\Reporters;

use Exception;

class SentryReporter implements ReporterInterface
{
    /**
     * @param Exception $exception
     * @return mixed
     */
    public function report(Exception $exception)
    {
        // TODO: Implement report() method.
    }
}
