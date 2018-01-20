<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Exception Language Lines
      |--------------------------------------------------------------------------
      |
      | The following language lines are used during exceptions for various
      | messages and titles that are displayed by the exceptions handler.
      | You should modify these language files to fit your application.
      |
      */
    'defaultException' => [
        'title' => 'Error',
        'message' => 'Something went wrong'
    ],

    \DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class => [
        'title' => 'Not found',
        'message' => 'The requested resource was not found'
    ],

    \DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException::class => [
        'title' => 'Http method not allowed',
        'message' => 'The requested Http method was not allowed'
    ],

    \DeveoDK\Core\Exception\Exceptions\Http\ToManyRequestsException::class => [
        'title' => 'To many requests',
        'message' => 'There have been to many request in the given amount of time'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\CreationFailedException::class => [
        'title' => 'Creation failed',
        'message' => 'Failed to create resource'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\DeleteFailedException::class => [
        'title' => 'Delete failed',
        'message' => 'Failed to delete resource'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\ReadFailedException::class => [
        'title' => 'Read failed',
        'message' => 'Failed to retrieve resource'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\UpdateFailedException::class => [
        'title' => 'Update failed',
        'message' => 'Failed to update resource'
    ],
];
