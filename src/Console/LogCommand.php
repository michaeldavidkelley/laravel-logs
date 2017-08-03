<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

use Illuminate\Console\Command;

abstract class LogCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    abstract public function handle();

    protected function getLogPath($loggingType)
    {
        $logPath = storage_path('logs/laravel.log');

        if (!is_file($logPath)) {
            $this->error('Log file could not be found! ['.$logPath.']');

            exit;
        }

        return $logPath;
    }

    protected function getLogType()
    {
        $loggingType = config('app.log');

        if (!$loggingType) {
            $this->error('Could not determine the logging type (app.log)');

            exit;
        }

        return $loggingType;
    }
}
