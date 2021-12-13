<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLinkMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendLinkMail')
            ->subject('Shiko filmin Shkembimi')
            ->with([
                'actionUrl' => config('app.url').'/shiko-filmin',
                'actionText' => "Shiko filmin",
                'salutation' =>  "Shikim te kendeshem!",
            ]);
1
        ;
    }
}
