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
    'reporter' => \DeveoDK\Core\Exception\Reporters\SentryReporter::class,

    /**
     * What exception handler should be used?
     * Use ENV to set, default is core.
     */
    'exception_handler' => env('EXCEPTION_HANDLER', 'core'),

    /**
     * Should every exception except the ones in ignore array be reported,
     * The default logging level is info and info exceptions wont be reported if false
     * Use ENV to set, default is true
     */
    'exception_report_everything' => env('EXCEPTION_REPORT_EVERYTHING', true),

    /**
     * Should the exception show whoops response in array,
     * WARNING: This will expose the current env
     */
    'exception_show_whoops' => env('EXCEPTION_SHOW_WHOOPS', false),

    /*
     * Exception codes for the core exception based platform.
     */
    'error_codes' => [
        // A1000 series
        'Creation failed' => [
            'A1000' => \DeveoDK\Core\Exception\Exceptions\Crud\CreationFailedException::class,
        ],

        // A2000 series
        'Deletion failed' => [
            'A2000' => \DeveoDK\Core\Exception\Exceptions\Crud\DeleteFailedException::class,
        ],

        // A3000 series
        'Update failed' => [
            'A3000' => \DeveoDK\Core\Exception\Exceptions\Crud\UpdateFailedException::class,
        ],

        // A4000 series
        'Read failed' => [
            'A4000' => \DeveoDK\Core\Exception\Exceptions\Crud\ReadFailedException::class
        ],

        // B1000 series
        'Notification failed' => [],

        // C1000 series
        'Framework general errors' => [
            'C1000' => \DeveoDK\Core\Exception\Exceptions\Http\ToManyRequestsException::class,
            'C1001' => \DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException::class,
            'C1003' => \DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class,
            'C1004' => \DeveoDK\Core\Exception\Exceptions\Validation\ValidationException::class,
        ],

        // D1000 series
        'Authorization errors' => [],
    ],
];
