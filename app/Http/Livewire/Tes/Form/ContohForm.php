<?php

namespace App\Http\Livewire\Tes\Form;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use App\Models\DataPegawai;
use App\Events\ContohEvent;

class ContohForm extends Component
{

    use WithFileUploads;

    protected $listeners = ['edit' => 'editData'];


    public  $nrk,
        $telpon,
        $email,
        $foto;

    public function render()
    {
        return view('tes.livewire.form.contoh-form');
    }

    public function editData($nrk)
    {
        $this->resetData();
        $query = DB::table('pegawai')->where('nrk', '=', $nrk)->first();

        $this->telpon = $query->telpon;
        $this->email = $query->email;
        $this->nrk = $nrk;

        // url foto tidak diambil, karena sering menyebabkan error
        // dan kebanyakan web tidak melakukan hal tsb
        // $this->foto = $query->foto;
    }

    public function resetData()
    {
        $this->telpon = "";
        $this->email = "";
        $this->nrk = "";
        $this->foto = null;
    }

    public function save()
    {
        $this->validate(
            [
                'foto' => 'image|max:1024|nullable',
                'email' => 'email|nullable',
                'telpon' => 'numeric|nullable'
            ],
            [
                'foto.image' => 'Harus berupa file gambar.',
                'foto.max' => 'Ukuran file terlalu besar (max 1mb)',
                'email' => 'Masukan format email yang benar.',
                'telpon' => 'Masukan nomer telpon'
            ]
        );

        $feed = null;

        if (!is_null($this->foto) || $this->foto != "") {
            error_log('git');
            $feed = $this->nrk . '_ava.jpg';
            $path = $this->foto->storeAs('img/avatar/user', $feed);
        }

        $pegawai = DataPegawai::find($this->nrk);

        if (is_null($feed)) {
            $pegawai->telpon = $this->telpon;
            $pegawai->email = $this->email;
        } else {
            $pegawai->telpon = $this->telpon;
            $pegawai->email = $this->email;
            $pegawai->foto = $this->feed;
        }
        $pegawai->save();

        if (!is_null($this->foto)   || $this->foto != "")
            $this->emit('ubahTest',  'SUKSES! tersimpan sebagai : ' . $path . "\r\n Eloquent : " . $pegawai);
        else
            $this->emit('ubahTest', "Data berhasil diubah" . "\r\n Eloquent : " . $pegawai);

        $this->resetData();
        $this->emit('refreshLivewireDatatable');
    }

    public function testEvent()
    {
        // ContohEvent::dispatch('test');
        event(new ContohEvent('123'));
    }
}
