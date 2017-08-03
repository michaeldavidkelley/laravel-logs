<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

class LogListCommand extends LogCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the log files';

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

        $this->info($logPath);
    }
}
