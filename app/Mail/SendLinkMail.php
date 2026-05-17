<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLinkMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $expiresAt;

    public function __construct(string $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    public function build()
    {
        return $this->markdown('emails.sendLinkMail')
            ->subject('Shiko filmin ME FAT')
            ->with([
                'expiresAt'  => $this->expiresAt,
                'actionUrl'  => config('app.url') . '/accept-agreement',
                'actionText' => 'Shiko Filmin',
                'salutation' => 'Shikim të këndshëm!',
            ]);
    }
}
