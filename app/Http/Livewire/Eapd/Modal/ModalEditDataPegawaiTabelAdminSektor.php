<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Models\Eapd\Grup;
use App\Models\Eapd\Pegawai;
use App\Models\Eapd\Penempatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Throwable;

class ModalEditDataPegawaiTabelAdminSektor extends Component
{

    public 
        $list_penempatan = [],
        $list_grup = [],
        $list_aktif = [
            ['value' => '1', 'text'=>"Masih Aktif"],
            ['value' => '0', 'text'=>"Tidak Aktif / Pensiun"],
        ];

    public 
        $nrk = "",
        $nip = "",
        $nama = "",
        $grup = "",
        $penempatan = "",
        $email = "",
        $telp = "",
        $aktif = "";

    public 
        $cache_nrk = "",
        $cache_nip = "",
        $cache_nama = "",
        $cache_grup = "",
        $cache_penempatan = "",
        $cache_email = "",
        $cache_telp = "",
        $cache_aktif = "";

    protected $listeners = [
        'panggilModalKepegawaian' => 'inisiasiModal'
    ];

    protected $rules = [
        'penempatan' => 'required',
        'grup' => 'required'
    ];

    public function render()
    {
        return view('eapd.livewire.modal.modal-edit-data-pegawai-tabel-admin-sektor');
    }

    public function inisiasiModal($value)
    {
        try
        {
            // ambil nrk
            $this->nrk = $this->cache_nrk = $value;

            error_log('nrk '.$this->nrk);

            // ambil data pegawai
            $pegawai = Pegawai::where('nrk','=',$this->nrk)->first();

            // inisiasi data lainnya
            $this->nama = $this->cache_nama = $pegawai->nama;
            $this->nip = $this->cache_nip = $pegawai->nip;
            $this->grup = $this->cache_grup = $pegawai->id_grup;
            $this->penempatan = $this->cache_penempatan = $pegawai->id_penempatan;
            $this->email = $this->cache_email = $pegawai->email;
            $this->telp = $this->cache_telp = $pegawai->telp;
            $this->aktif = $this->cache_aktif = $pegawai->aktif;

            //ambil data pos sektor, kecuali nama sektor
            $this->list_penempatan = [];
            
            $query_penempatan = Penempatan::where('id_penempatan','like',Auth::user()->data->sektor.'%')
                    // ->where('id_penempatan','!=',Auth::user()->data->sektor)
                    ->get();

            foreach($query_penempatan as $q)
            {
                array_push($this->list_penempatan,[
                    'value' => $q->id_penempatan,
                    'text' => $q->nama_penempatan
                ]);
            }

            // ambil data grup
            $this->list_grup = [];
            
            $query_grup = Grup::all();

            foreach($query_grup as $q)
            {
                array_push($this->list_grup,[
                    'value' => $q->id_grup,
                    'text' => $q->nama_grup
                ]);
            }

            $this->selectGrupDirubah();
            // return dd($this->list_penempatan);
        }
        catch(Throwable $e)
        {
            error_log($e);
        }
    }

    public function selectGrupDirubah()
    {

        try{
            if($this->penempatan == Auth::user()->data->sektor && in_array($this->grup,['A','B','C']))
            {
                $tempat = Penempatan::where('id_penempatan','=',Auth::user()->data->sektor)->first()->nama_penempatan;
                $this->penempatan = "";
                session()->flash('warning-penempatan','Penempatan '.$tempat.' hanya untuk yang tidak memiliki grup jaga.');
            }
        }
        catch(Throwable $e)
        {

        }


    }

}
