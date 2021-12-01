<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendEmail
 * @package App\Mail
 */
class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private string $name;
    private string $description;

    /**
     * SendEmail constructor.
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name,string $description)
    {
        $this->name  = $name;
        $this->description  = $description;
    }

    /**
     * @return SendEmail
     */
    public function build()
    {
        return $this->from(config('mail.reply_to'))
                    ->subject('Product')
                    ->view('email.send-email', ['name' => $this->name, 'description' => $this->description]);
    }
}
