<?php

namespace MichaelDavidKelley\LaravelLogs\Console;

class LogMailCommand extends LogCommand
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
        $emails = $this->getEmails();
        $loggingType = $this->getLogType();
        $logPath = $this->getLogPath($loggingType);

        $subject = config('app.name', 'Laravel Project') . ' - Log File - ' . date('Y-m-d H:i:s');

        $emails->each(function ($email) use ($logPath, $subject) {
            try {
                \Mail::raw('Log file is attached.', function ($message) use ($email, $logPath, $subject) {
                    $message->subject($subject)->to($email)->attach($logPath);
                });
                $this->info('Emailed Log file to ' . $email);
            } catch (\Exception $e) {
                $this->error("Could not send the email [{$email}]: {$e->getMessage()}");
            }
        });
    }

    private function getEmails()
    {
        $emails = collect(explode(',', $this->argument('email')));
        $badEmails = $emails->reject(function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        })->each(function ($email) {
            $this->error("Invalid Email [{$email}].");
        });

        if ($badEmails->count()) {
            exit;
        }

        return $emails;
    }
}
