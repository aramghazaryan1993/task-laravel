<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    /**
     * Class SendEmail
     * @package App\Mail
     */

    use Queueable, SerializesModels;
    public $emailData;

    /**
     * SendEmail constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->emailData  = $data;
    }


    /**
     * @return SendEmail
     */
    public function build()
    {
        return $this->from('aramghazaryan2@gmail.com', 'Product')
                    ->subject('Product')
                    ->view('email.send-email', ['mailData' => $this->emailData]);
    }
}
