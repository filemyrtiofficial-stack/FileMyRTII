<?php

namespace App\Mail\Lawyer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApproveRti extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        if($this->data['appeal_no'] == 0) {
            return new Envelope(
                subject: 'RTI Draft Approved - Ready for Filing - Application No : '.$this->data['application_no'],
            );
        }
        else if($this->data['appeal_no'] == 1) {
            return new Envelope(
                subject: 'First Appeal (RTI) Draft Approved - Ready for Filing - Application No : '.$this->data['application_no'],
            );
        }
        else {
            return new Envelope(
                subject: 'Second Appeal (RTI) Draft Approved - Ready for Filing - Application No : '.$this->data['application_no'],
            );
        }

        
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.lawyer.approve_rti',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
