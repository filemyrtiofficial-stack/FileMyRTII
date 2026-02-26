<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('send-appeal-notification')->dailyAt("10:00");
        // $schedule->command('follow-up-mail')->dailyAt("11:00");
        
        // ADDED: Schedule the command to check for abandoned applications every hour.
        $schedule->command('app:check-abandoned-applications')->hourly(); 
        
        $schedule->command('queue:work')->everyMinute();
    }
    
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}