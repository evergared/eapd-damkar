<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;  //<---penting agar event dapat digunakan untuk broadcast atau untuk webhook
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\ContohModel;

class ContohEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // data yang dimiliki oleh event, bisa diatur bebas
    public $nrk;

    /**
     * Create a new event instance. (Konstruktor)
     *
     * @return void
     */
    public function __construct($nrk)
    {
        $this->id_pegawai = $id_pegawai;
    }

    /**
     * Broadcast event pada channel yang di return
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        error_log('broadcast on evoked' . $this->nrk);
        return new Channel('tes');                  //<--publik channel
        // return new PrivateChannel('tes.' . $this->nrk);
    }

    /**
     * Menyamarkan event pada saat broadcast
     */
    // public function broadcastAs()
    // {
    //     error_log('broadcast as evoked');
    //     // return 'tes';            
    //     // return 'ContohEvent';                 //<--tidak dapat mengirim data, hanya menyamarkan event ini sebagai ContohEvent di webhook
    // }

    /**
     * Sangkutkan data tambahan pada saat broadcast
     * Data yang di sangkutkan akan menjadi json di webhook
     * ref : https://laravel.com/docs/9.x/broadcasting#broadcast-data
     */
    public function broadcastWith()
    {
        error_log('broadcast with evoked');
        // return ['nrk' => $this->model->nrk]
    }
}
