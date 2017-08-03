<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

use Illuminate\Console\Command;

class LogTailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:tail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tail the current Laravel log file';

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
    public function handle()
    {
        $loggingType = config('app.log');

        if (!$loggingType) {
            $this->error('Could not determine the logging type (app.log)');

            return;
        }

        $logPath = $this->getLogPath($loggingType);

        if (!is_file($logPath)) {
            $this->error('Log file could not be found! ['.$logPath.']');

            return;
        }

        $handle = popen("tail -F $logPath 2>&1", 'r');

        while (!feof($handle)) {
            echo fgets($handle);
        }

        pclose($handle);
    }

    private function getLogPath($loggingType)
    {
        return storage_path('logs/laravel.log');
    }
}
