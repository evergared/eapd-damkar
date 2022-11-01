<?php

namespace App\Http\Livewire\Form;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ContohForm extends Component
{

    protected $listeners = ['edit' => 'editData'];


    public $nrk, $telpon, $email;

    public function render()
    {
        return view('livewire.form.contoh-form');
    }

    public function editData($nrk)
    {
        $query = DB::table('pegawai')->where('nrk', '=', $nrk)->first();

        $this->telpon = $query->telpon;
        $this->email = $query->email;
        $this->nrk = $nrk;
    }

    public function resetData()
    {
        $this->telpon = "";
        $this->email = "";
        $this->nrk = "";
    }

    public function save()
    {
        DB::table('pegawai')->where('nrk', $this->nrk)->update(['telpon' => $this->telpon, 'email' => $this->email]);
        $this->resetData();
        $this->emit('refreshLivewireDatatable');
    }
}
