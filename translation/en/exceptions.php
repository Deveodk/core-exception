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

    'NotFoundException' => [
        'title' => 'Not found',
        'message' => 'The requested resource was not found'
    ],

    'MethodNotAllowedException' => [
        'title' => 'Http method not allowed',
        'message' => 'The requested Http method was not allowed'
    ],

    'ToManyRequestsException' => [
        'title' => 'To many requests',
        'message' => 'There have been to many request in the given amount of time'
    ],

    'CreationFailedException' => [
        'title' => 'Creation failed',
        'message' => 'Failed to create resource'
    ],

    'DeleteFailedException' => [
        'title' => 'Delete failed',
        'message' => 'Failed to delete resource'
    ],

    'ReadFailedException' => [
        'title' => 'Read failed',
        'message' => 'Failed to retrieve resource'
    ],

    'UpdateFailedException' => [
        'title' => 'Update failed',
        'message' => 'Failed to update resource'
    ],

    'ServerException' => [
        'title' => 'Server error',
        'message' => 'Something went wrong on our side'
    ]
];
