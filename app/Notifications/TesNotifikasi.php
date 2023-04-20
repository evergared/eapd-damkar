<?php

namespace App\Notifications;

// use BeyondCode\LaravelWebSockets\WebSockets\Channels\PrivateChannel;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TesNotifikasi extends Notification implements ShouldBroadcast
{
    use Queueable,Dispatchable,InteractsWithSockets;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        printf('tes notifikasi triggered');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
        // return ['database','broadcast']; <-- pakai ini nanti
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'pesan' => 'test pesan',
            'id_pesan' => 'identifikasi'
        ];
    }

    public function toBroadcast()
    {
        $chanel = 'danton-1.11-B';
        error_log('broadcast pada '.$chanel);
        // return new Channel('tes');
        return new PrivateChannel($chanel);
    }
}
