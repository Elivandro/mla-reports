<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $fileName
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Relatorio gerado',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.report',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('s3', $this->fileName)
        ];
    }
}
