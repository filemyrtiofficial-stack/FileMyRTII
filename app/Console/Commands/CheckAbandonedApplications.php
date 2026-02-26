<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RtiApplication;
use Carbon\Carbon;
use App\Jobs\SendEmail; // Assuming this is your general email dispatch job

class CheckAbandonedApplications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-abandoned-applications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for applications abandoned in the payment step and triggers recovery emails.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define the abandonment threshold (e.g., 2 hours). 
        // We only want to email applications abandoned at least 2 hours ago.
        $abandonedThresholdInHours = 2; 

        $cutoffTime = Carbon::now()->subHours($abandonedThresholdInHours);

        // Query for abandoned applications:
        // 1. payment_status is 'pending'
        // 2. abandoned_at time is older than the cutoff time
        // 3. reminder_sent_at is NULL (to ensure we only send the reminder once)
        $abandonedApplications = RtiApplication::where('payment_status', 'pending')
            ->whereNotNull('abandoned_at')
            ->where('abandoned_at', '<', $cutoffTime)
            ->whereNull('reminder_sent_at')
            ->get();

        if ($abandonedApplications->isEmpty()) {
            $this->info('No abandoned applications found older than ' . $abandonedThresholdInHours . ' hours.');
            return Command::SUCCESS;
        }

        $this->info('Found ' . $abandonedApplications->count() . ' abandoned applications to process.');
        
        $count = 0;
        foreach ($abandonedApplications as $application) {
            // Dispatch the Email Job (The first parameter 'abandoned-application' is the mailer key)
            SendEmail::dispatch('abandoned-application', $application);

            // Update the application to prevent sending the reminder again
            $application->update([
                'reminder_sent_at' => Carbon::now()
            ]);
            $count++;
        }

        $this->info("Successfully sent {$count} abandoned application reminders.");

        return Command::SUCCESS;
    }
}