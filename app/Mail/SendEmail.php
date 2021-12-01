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

    public string $name;
    public string $description;

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
        return $this->from('aramghazaryan2@gmail.com', 'Product')
                    ->subject('Product')
                    ->view('email.send-email', ['name' => $this->name,'description' => $this->description]);
    }
}
