<?php

namespace MichaelDavidKelley\LaravelLogs;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \MichaelDavidKelley\LaravelLogs\Console\TailLogCommand::class
        ]);
    }
}
