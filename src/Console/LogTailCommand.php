<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

class LogTailCommand extends LogCommand
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
        $loggingType = $this->getLogType();
        $logPath = $this->getLogPath($loggingType);

        $handle = popen("tail -F $logPath 2>&1", 'r');

        while (!feof($handle)) {
            echo fgets($handle);
        }

        pclose($handle);
    }
}
