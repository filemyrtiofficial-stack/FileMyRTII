<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RtiApplication;
use carbon\Carbon;
class SendAppealCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-appeal-notification';

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

        $date = Carbon::now()->subDays('30');
        $applications = RtiApplication::doesnothave('firstAppeal')->join('application_statuses', 'application_statuses.application_id', '=', 'rti_applications.id')
        ->where('rti_applications.appeal_no', 0)
        ->where('application_statuses.status', 'filed')
        ->wheredate('created_at', $date)->select('application_statuses')
        ->get();
        foreach($applications as $application) {

        }

        // return Command::SUCCESS;
    }
}
