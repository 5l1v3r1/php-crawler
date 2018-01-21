<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BuildCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the crawler app';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): bool
    {
        $this->comment('Installing Laravel Passport');

        $returnCode = $this->callSilent('passport:install');

        if ($returnCode !== 0) {
            $this->error('Unable to install Laravel Passport');

            return false;
        } else {
            $this->info('Laravel Passport installed');
            $this->line('---');
        }

        $this->comment('Running application migrations');

        $returnCode = $this->call('migrate:fresh');

        if ($returnCode !== 0) {
            $this->error('Unable run the application migrations');

            return false;
        } else {
            $this->info('Application migrations ok');
            $this->line('---');
        }

        $this->info('Crawler app ready!');

        return true;
    }
}
