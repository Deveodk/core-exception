<?php

namespace DeveoDK\Exception\Tests\Exceptions\Crud;

use DeveoDK\Core\Exception\Exceptions\Crud\ReadFailedException;
use Orchestra\Testbench\TestCase;

class ReadFailedExceptionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Can find exception code
     * @test
     */
    public function canFindExceptionCode()
    {
        $exception = new ReadFailedException();

        $this->assertEquals('A4000', $exception->getCoreExceptionCode());
    }

    /**
     * Can find exception status code
     * @test
     */
    public function canFindExceptionStatus()
    {
        $exception = new ReadFailedException();

        $this->assertEquals(404, $exception->getStatusCode());
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('core.exception', [/*
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

            /*
             * Exception codes for the core exception based platform.
             */
            'error_codes' => [
                // Creation failed
                'A1000' => [
                    'A1000' => \DeveoDK\Core\Exception\Exceptions\Crud\CreationFailedException::class,
                ],

                // Deletion failed
                'A2000' => [
                    'A2000' => \DeveoDK\Core\Exception\Exceptions\Crud\DeleteFailedException::class,
                ],

                // Update failed
                'A3000' => [
                    'A3000' => \DeveoDK\Core\Exception\Exceptions\Crud\UpdateFailedException::class,
                ],

                // Read failed
                'A4000' => [
                    'A4000' => \DeveoDK\Core\Exception\Exceptions\Crud\ReadFailedException::class
                ],

                // Notification failed
                'B1000' => [],

                // Rate limited
                'C1000' => [
                    'C1000' => \DeveoDK\Core\Exception\Exceptions\Http\ToManyRequestsException::class,
                ],

                // Method not allowed
                'C2000' => [
                    'C2000' => \DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException::class,
                ],

                // Resource not found
                'C3000' => [
                    'C3000' => \DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class,
                ],

                // Validation
                'D1000' => [
                    'D1000' => \DeveoDK\Core\Exception\Exceptions\Validation\ValidationException::class,
                ],

                // Unauthorized
                'Q1000' => [],

                // OAUTH2 Callback failed
                'Q2000' => [],

                // To many login attempts
                'Q3000' => [],
            ]]);
    }
}
