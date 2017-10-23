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

    'NotFoundException' => [
        'title' => 'Ikke fundet',
        'message' => 'Den ønskede ressource blev ikke fundet'
    ],

    'MethodNotAllowedException' => [
        'title' => 'Http metode ikke tilladt',
        'message' => 'Den anmodede Http-metode var ikke tilladt'
    ],

    'ToManyRequestsException' => [
        'title' => 'Til mange anmodninger',
        'message' => 'Der har været mange forespørgsler i det givne tidsrum'
    ],

    'CreationFailedException' => [
        'title' => 'Creation failed',
        'message' => 'Kunne ikke oprette ressource'
    ],

    'DeleteFailedException' => [
        'title' => 'Slet mislykket',
        'message' => 'Kunne ikke slette ressource'
    ],

    'ReadFailedException' => [
        'title' => 'Læs mislykket',
        'message' => 'Kunne ikke hente ressource'
    ],

    'UpdateFailedException' => [
        'title' => 'Opdatering mislykkedes',
        'message' => 'Kunne ikke opdatere ressource'
    ]

];
