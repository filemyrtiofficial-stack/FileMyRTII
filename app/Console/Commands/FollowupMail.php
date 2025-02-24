<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LawyerRtiQuery;
use App\Jobs\SendEmail;
use carbon\Carbon;

class FollowupMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:follow-up-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $applications = RtiApplication::where('status', '<', 2)->wherehas('lastRevision', function($query) {
            $query->whereNull('customer_change_request');
        })->get();
        foreach($applications as $application) {
            SendEmail::dispatch('draft-rti', $application);
        }
      
        $queries = LawyerRtiQuery::whereNull('reply')
        ->join('rti_applications', 'rti_applications.id', '=', 'lawyer_rti_queries.application_id')
        ->where('rti_applications.status', '<', 3)
        ->get();        
        foreach($queries as $query) {
            SendEmail::dispatch('more-info', $query->rtiApplication);
  
        }

        // return Command::SUCCESS;
    }
}
