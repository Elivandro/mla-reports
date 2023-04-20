<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class Example extends Command implements Isolatable
{
    protected $signature = 'example {name} {--e|askEmail}';

    protected $description = 'A simple example command';

    public function handle()
    {
        $name = $this->argument('name');
        
        logger($name. ' Example command executed');
        
        $askEmail = $this->option('askEmail');

        $arguments = $this->argument();


        if($askEmail){
            $askEmail = $this->ask('What is your email address?');
            $password = $this->secret('enter the password');

            $agree = $this->anticipate('Do you agree this terms and conditions?', ['yes', 'no']);

            $choices = $this->choice(
                'Do you agree this terms and conditions?',
                ['yes', 'no'],
                0,
                2);
        }

        logger("Email: $askEmail and password: $password and Agree: $agree and choices: $choices");

        return Command::SUCCESS;
    }

    public function isolationLockExpiresAt()
    {
        return now()->addMinutes(5);
    }
}
