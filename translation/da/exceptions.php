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
        'title' => 'Fejl',
        'message' => 'Der er desværre sket en fejl'
    ],

    \DeveoDK\Core\Exception\Exceptions\Http\ResourceNotFoundException::class => [
        'title' => 'Ikke fundet',
        'message' => 'Den ønskede ressource blev ikke fundet'
    ],

    \DeveoDK\Core\Exception\Exceptions\Http\MethodNotAllowedException::class => [
        'title' => 'Http metode ikke tilladt',
        'message' => 'Den anmodede Http-metode var ikke tilladt'
    ],

    \DeveoDK\Core\Exception\Exceptions\Http\ToManyRequestsException::class => [
        'title' => 'Til mange anmodninger',
        'message' => 'Der har været mange forespørgsler i det givne tidsrum'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\CreationFailedException::class => [
        'title' => 'Creation failed',
        'message' => 'Kunne ikke oprette ressource'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\DeleteFailedException::class => [
        'title' => 'Slet mislykket',
        'message' => 'Kunne ikke slette ressource'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\ReadFailedException::class => [
        'title' => 'Læs mislykket',
        'message' => 'Kunne ikke hente ressource'
    ],

    \DeveoDK\Core\Exception\Exceptions\Crud\UpdateFailedException::class => [
        'title' => 'Opdatering mislykkedes',
        'message' => 'Kunne ikke opdatere ressource'
    ]
];
