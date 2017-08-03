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
        $files = $this->getLogFiles();

        collect($files)->each(function ($file) {
            if (!unlink($file)) {
                $this->error('Could not delete the log file: ' . $file);
            } else {
                $this->info('Deleted log file: ' . $file);
            }
        });
    }
}
