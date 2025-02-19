<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RtiApplication;
class FollowupMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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

        // $list = RtiApplication::where('status', 1)->wherehas('lastRevision', function($query) {
        //     $query->whereNull('customer_change_request')
        // })
        return Command::SUCCESS;
    }
}
