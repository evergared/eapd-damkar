<?php

namespace App\Http\Livewire\Tes\Form;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use App\Models\Tes\DataPegawai;
use App\Events\ContohEvent;
use App\Models\ContohModel;

class ContohForm extends Component
{

    use WithFileUploads;

    protected $listeners = ['edit' => 'editData'];


    public  $id_pegawai = "",
        $telpon = "",
        $email = "",
        $foto = null,
        $upload = null;

    public function render()
    {
        return view('tes.livewire.form.contoh-form');
    }

    public function editData($id_pegawai)
    {
        $this->resetData();
        $query = ContohModel::where('id', '=', $id_pegawai)->first();

        $this->telpon = $query->no_telp;
        $this->email = $query->email;
        $this->id_pegawai = $id_pegawai;

        // url foto tidak diambil, karena sering menyebabkan error
        // dan kebanyakan web tidak melakukan hal tsb
        // $this->foto = $query->foto;
    }

    public function resetData()
    {
        $this->telpon = "";
        $this->email = "";
        $this->id_pegawai = "";
        $this->foto = null;
    }

    public function save()
    {
        $this->validate(
            [
                'foto' => 'image|max:1024|nullable',
                'email' => 'email|nullable',
                'telpon' => 'nullable'
            ],
            [
                'foto.image' => 'Harus berupa file gambar.',
                'foto.max' => 'Ukuran file terlalu besar (max 1mb)',
                'email' => 'Masukan format email yang benar.',
                'telpon' => 'Masukan nomer telpon'
            ]
        );

        error_log('first');


        if (!is_null($this->foto) || $this->foto != "") {
            error_log('git');
            $this->upload = $this->nrk . '_ava.jpg';
            $path = $this->foto->storeAs('img/avatar/user', $this->upload);
        }

        $pegawai = DataPegawai::where('nrk', '=', $this->nrk)->first();

        if (is_null($this->upload)) {
            error_log('second 1' . $this->telpon);
            $pegawai->no_telp = $this->telpon;
            $pegawai->email = $this->email;
        } else {
            error_log('second 2' . $this->telpon);
            $pegawai->no_telp = $this->telpon;
            $pegawai->email = $this->email;
            $pegawai->foto = $this->upload;
        }
        $pegawai->save();
        error_log('third' . $this->upload);
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
