<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

class LogDeleteCommand extends LogCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the current Laravel log file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $loggingType = $this->getLogType();
        $logPath = $this->getLogPath($loggingType);

        if (!unlink($logPath)) {
            $this->error('Could not delete the log file.');

            return;
        }

        $this->info('Log File Successfully Deleted.');
    }
}
