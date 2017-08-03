<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

use Illuminate\Console\Command;

class LogMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:mail {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email the current log file';

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
        $email = $this->argument('email');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('The email is not valid.');

            return;
        }


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

        \Mail::raw('Log file is attached.', function ($message) use ($email, $logPath) {
            $message->subject(config('app.name', 'Laravel Project') . ' - Log File - ' . date('Y-m-d H:i:s'));

            $message->to($email);

            $message->attach($logPath);
        });
    }

    private function getLogPath($loggingType)
    {
        return storage_path('logs/laravel.log');
    }
}
