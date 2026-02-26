<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationRegister extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $paymentdata;

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
                subject: 'RTI Payment Received- Application No : '.$this->data['application_no'],
            );
        }
        elseif($this->data['appeal_no'] == 1) {

            return new Envelope(
                subject: 'First Appeal RTI Payment Received- Application No: '.$this->data['application_no'] ?? '',
            );
        }
        else {
            return new Envelope(
                subject: 'Second Appeal RTI Payment Received - Application No: '.$this->data['application_no'] ?? '',
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
            view: 'email.admin.application_resgister',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
    //   $application_no =  $this->data["application_no"];
    //  $appeal_no =  $this->data["appeal_no"];
    //    $fileName = 'invoice_' .$application_no .'_appeal_no_'.$appeal_no.'.pdf';
        return [
            asset($this->data['invoice_path'])
        ];
    }
}
