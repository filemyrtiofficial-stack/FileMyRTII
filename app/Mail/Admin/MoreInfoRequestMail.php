<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MoreInfoRequestMail extends Mailable
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
        if($this->data->rtiApplication->appeal_no == 0) {

            return new Envelope(
                subject: 'Lawyer requested more info from the customer (Application No: '.$this->data->rtiApplication['application_no'].')',
            );
        }
        elseif($this->data->rtiApplication->appeal_no == 1) {
            return new Envelope(
                subject: 'Lawyer requested more info from the customer (Application No: '.$this->data->rtiApplication['application_no'].')',
            );
        }
        elseif($this->data->rtiApplication->appeal_no == 2) {
            return new Envelope(
                subject: 'Lawyer requested more info from the customer (Application No: '.$this->data->rtiApplication['application_no'].')',
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
            view: 'email.admin.more-info',
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
