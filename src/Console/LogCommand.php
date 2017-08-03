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
        $filename = 'laravel.log';

        if ($loggingType == 'daily') {
            $filename = 'laravel-'.date('Y-m-d').'.log';
        }

        $logPath = storage_path('logs/' . $filename);

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

    protected function getLogFiles()
    {
        $files = [];

        $filesInDirectory = \File::allFiles(storage_path());

        foreach ($filesInDirectory as $file) {
            if (preg_match('/laravel(-[0-9]{4}-[0-9]{2}-[0-9]{2})?\.log/', $file, $matches)) {
                $files[] = $file;
            }
        }

        return $files;
    }
}
