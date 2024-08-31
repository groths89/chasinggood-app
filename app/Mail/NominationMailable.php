<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NominationMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $first_name;
    public $last_name;
    public $nominee_name;

    /**
     * Create a new message instance.
     */
    public function __construct($first_name, $last_name, $nominee_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->nominee_name = $nominee_name;
    }

    public function build()
    {
        return $this->view('emails.nominated_by_nominator')->with('first_name', $this->first_name)->with('last_name', $this->last_name)->with('nominee_name', $this->nominee_name);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'You Have Been Nominated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.nominated_by_nominator',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
