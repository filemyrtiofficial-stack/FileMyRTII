<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;
use App\Models\RtiApplication;
class FiledRti extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
        public $attachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $html = RtiApplication::draftedApplication($data);
        $pdf = \PDF::loadHtml($html);
        $fileName = 'rti-application_' . $data->id . '.pdf';
        $folderPath = public_path('app/temp-pdfs');
    
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
    
        $pdf->save($folderPath . '/' . $fileName);
        $this->attachment = 'app/temp-pdfs/'.$fileName;
  
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
                subject: 'Your RTI Application Has Been Filed (Application No: '.$this->data['application_no'].')',
            );
        }
        else if($this->data['appeal_no'] == 1) {
            return new Envelope(
                subject: 'Your First Appeal is Filed – Tracking Number & Next Steps (Application No: '.$this->data['application_no'].')',
            );
        }
        else {
            return new Envelope(
                subject: 'Your Second Appeal is Filed – Tracking Details (Application No: '.$this->data['application_no'].')',
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
            view: 'email.filed_rti',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
          $array = [   asset($this->attachment)];
        if($this->data && $this->data->courierTracking && count($this->data->courierTracking->documents) > 0) {
            foreach($this->data->courierTracking->documents as $item) {

                array_push($array, asset($item));
            }
        }
        return $array;
    }
}
