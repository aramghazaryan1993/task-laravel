<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

/**
 * Class SendNotificationByCreateproduct
 * @package App\Notifications
 * @param  string $productName
 * @param  string $productDescription
 * @param  string $productImage
 */
class SendNotificationByCoproduct extends Notification
{
    use Queueable;

    private string $productName;
    private string $productDescription;
    private string $productImage;

    /**
     * SendNotificationByCreateproduct constructor.
     * @param string $productName
     * @param string $productDescription
     * @param string $productImage
     */
    public function __construct(string $productName,string $productDescription,string $productImage)
    {
        $this->productName        = $productName;
        $this->productDescription = $productDescription;
        $this->productImage       = $productImage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view(
                'email.send-email-notification', [
                    'name'        => $this->productName,
                    'description' => $this->productDescription,
                    'image'       => url(Storage::url($this->productImage))
                ]
            )->attach(url(Storage::url($this->productImage)));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
