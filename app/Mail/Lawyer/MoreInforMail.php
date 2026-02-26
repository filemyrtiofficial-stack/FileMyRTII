<?php

namespace App\Mail\Lawyer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MoreInforMail extends Mailable
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
                subject: 'More Information Provided for RTI Application No.: '.$this->data->rtiApplication['application_no'],
            );
        }
        elseif($this->data->rtiApplication->appeal_no == 1) {
            return new Envelope(
                subject: 'Additional Information Received – Please Review and Draft First Appeal (Application No: '.$this->data->rtiApplication['application_no'].')',
            );
        }
        elseif($this->data->rtiApplication->appeal_no == 2) {
            return new Envelope(
                subject: 'Additional Information Received – Please Review and Draft Second Appeal (Application No: '.$this->data->rtiApplication['application_no'].')',
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
            view: 'email.lawyer.more-info-required',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
       if(!empty($this->data->documents)) {

            $documents = [];
            foreach($this->data->documents as $doc) {
                array_push($documents, asset($doc));
            }
            return $documents;
        }
        return [];
    }
}
