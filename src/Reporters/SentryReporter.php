<?php

namespace DeveoDK\Core\Exception\Reporters;

use Exception;
use InvalidArgumentException;
use Raven_Client;

class SentryReporter implements ReporterInterface
{
    /**
     * SentryReporter constructor.
     */
    public function __construct()
    {
        if (!class_exists(Raven_Client::class)) {
            throw new InvalidArgumentException("Sentry client is not installed. Use composer require sentry/sentry.");
        }
    }

    /**
     * This is the report method. This will be called when a new exception happens
     * It must return either null or a string containing the ID of the report
     * @param Exception $exception
     * @return string|null
     */
    public function report(Exception $exception)
    {
        if (!app()->bound('sentry')) {
            return null;
        }

        /** @var Raven_Client $sentry */
        $sentry = app('sentry');

        $sentry->captureException($exception);

        return $sentry->getLastEventID();
    }
}
