<?php

namespace DeveoDK\Core\Exception;

use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Providers boot method
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../translation/en/exceptions.php' => resource_path('lang/en/exceptions.php'),
        ]);
        $this->publishes([
            __DIR__ . '/../translation/da/exceptions.php' => resource_path('lang/da/exceptions.php'),
        ]);
    }
}
