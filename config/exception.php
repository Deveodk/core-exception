<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Exception Config file
      |--------------------------------------------------------------------------
      |
      | Here you may configure the exception reporter used in the application
      | Leave empty if no reporter are used. Support for custom reporters
      | Are available but must follow the ReporterInterface.
      |
      */
    'reporter' => \DeveoDK\Core\Exception\Reporters\SentryReporter::class

];
