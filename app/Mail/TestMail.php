<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {
        
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Mail',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
{
    return $this->subject('Hello from PinkTask')
                ->view('emails.test');
}


}
