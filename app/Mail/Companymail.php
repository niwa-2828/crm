<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Companymail extends Mailable
{
    use Queueable, SerializesModels;

    private string $mailSubject;
    private string $mailBody;

    public function __construct(string $subject, string $body)
    {
        $this->mailSubject = $subject;
        $this->mailBody = $body;
    }

    public function build()
    {
        return $this
            ->subject($this->mailSubject)
            // お作法。メール本文に使うBladeテンプレートの場所を指定。
            ->view('emails.company_mail')
            ->with([
                'body' => $this->mailBody,
            ]);
    }
}
