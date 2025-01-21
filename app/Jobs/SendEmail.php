<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ResetPassword;
use Mail;
class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $details)
    {
        $this->details = $details;
        $this->type = $type;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->type == 'reset-password') {
            $email = new ResetPassword($this->details);
        }
        Mail::to($this->details['email'])->send($email);
    }

    
}
