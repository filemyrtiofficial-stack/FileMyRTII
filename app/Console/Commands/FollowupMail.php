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

      $queries = LawyerRtiQuery::wherehas('rtiApplication')
      ->whereNull('reply')
      ->join('rti_applications', 'rti_applications.id', '=', 'lawyer_rti_queries.application_id')
      ->join('application_statuses', 'application_statuses.application_id', '=', 'lawyer_rti_queries.application_id')
      ->where('application_statuses.status', '!=','approved')
      ->where('application_statuses.status', '!=','filed')
      // ->wheredate('lawyer_rti_queries.created_at', $date)
      ->select('rti_applications.*','lawyer_rti_queries.*')
      ->get();
   
      foreach($queries as $query) {
          SendEmail::dispatch('more-info', $query->rtiApplication);

      }
        // return Command::SUCCESS;
    }
}
