<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\RtiApplication;

class AbandonedApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public RtiApplication $application;

    public function __construct(RtiApplication $application)
    {
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Action Required: Complete Your Application ' . $this->application->application_no,
        );
    }

    public function content(): Content
    {
        // Passes the application model to the email view as $data
        return new Content(
            markdown: 'emails.abandoned-application', 
            with: [
                'data' => $this->application,
            ],
        );
    }
    
    // ... optional attachments and build methods
}