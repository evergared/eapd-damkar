<?php

namespace App\Notifications;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PegawaiInputApd extends Notification implements ShouldBroadcast
{
    use Queueable, InteractsWithSockets;

    protected $pesan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pesan)
    {
        $this->pesan = $pesan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
            'id_pegawai' => $this['id_pegawai'],
            'id_jenis' => $this['id_jenis'],
            'tindakan' => $this['tindakan']
        ];
    }

    public function broadcastOn()
    {
        
    }
}
