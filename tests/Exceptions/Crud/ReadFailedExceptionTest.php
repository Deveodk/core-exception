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
            ]]);
    }
}
