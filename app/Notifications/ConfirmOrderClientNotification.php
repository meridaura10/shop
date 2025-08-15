<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use NotificationChannels\TurboSms\TurboSmsChannel;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\TurboSms\TurboSmsMessage;

class ConfirmOrderClientNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $via = ['mail'];

        if($notifiable->phone){
            $via[] = TurboSmsChannel::class;
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view('mail.confirm-order-client', ['order' => $this->order]);
    }

    public function toTurboSms($notifiable): TurboSmsMessage
    {
        return (new TurboSmsMessage())
            ->content("Замовлення підтверджено {$this->order->id}")
            ->test(config('services.turbosms.is_test'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
