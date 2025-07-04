<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BackupSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $backupUrl;

    public function __construct(string $backupUrl)
    {
        $this->backupUrl = $backupUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Backup Database HMIF SMI Malang Berhasil'
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.backup-success',
            with: [
                'url' => $this->backupUrl,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
