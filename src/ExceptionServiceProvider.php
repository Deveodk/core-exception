<?php

namespace DeveoDK\Core\Exception;

use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Register method
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/exception.php', 'core.exception');
    }

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
        $this->publishes([
            __DIR__ . '/../config/exception.php' => config_path('core/exception.php'),
        ]);
    }
}
