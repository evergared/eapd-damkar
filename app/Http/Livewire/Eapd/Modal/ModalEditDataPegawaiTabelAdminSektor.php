<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Models\Eapd\Grup;
use App\Models\Eapd\Pegawai;
use App\Models\Eapd\Penempatan;
use App\Models\User;
use App\Enum\TipeJabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $aktif = "",
        $password = "",
        $keterangan = "",
        $tipe_jabatan_user = "";

    public 
        $cache_nrk = "",
        $cache_nip = "",
        $cache_nama = "",
        $cache_grup = "",
        $cache_penempatan = "",
        $cache_email = "",
        $cache_telp = "",
        $cache_aktif = "";

    public 
        $jabatan_pegawai = "";

    public
        $user_ditemukan = false;

    public 
        $tipe_jabatan_personil = "",
        $tipe_jabatan_danton = "";

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

    /**
     * @todo
     */
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

            $this->jabatan_pegawai = $pegawai->jabatan->nama_jabatan;
            $this->tipe_jabatan_user = $pegawai->jabatan->tipe_jabatan;

            $this->tipe_jabatan_personil = TipeJabatan::personil()->value;
            $this->tipe_jabatan_danton = TipeJabatan::danton()->value;

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

            // cek apakah ada user dengan nrk tersebut
            $this->user_ditemukan = User::where('nrk','=',$this->cache_nrk)->first() != "";


            $this->koreksiPenempatanDanGrup();

        }
        catch(Throwable $e)
        {
            error_log($e);
        }
    }

    public function simpanPerubahanData()
    {
        try{

            $pegawai = Pegawai::where('nrk','=',$this->cache_nrk)->first();
            $pegawai->id_grup = $this->grup;
            $pegawai->id_penempatan = $this->penempatan;
            $pegawai->nama = $this->nama;
            $pegawai->nrk = $this->nrk;
            $pegawai->nip = $this->nip;
            $pegawai->email = $this->email;
            $pegawai->no_telp = $this->telp;
            $pegawai->aktif = $this->aktif;



        }
        catch(Throwable $e)
        {
            error_log('Gagal melakukan perubahan data '.$e);
        }
    }

    public function simpanPerubahanPassword()
    {
        $this->validate(
            ['password' => 'required|min:6'],
            [
                'password.required' => 'Field ini tidak boleh kosong untuk mengganti password.',
                'password.min' => 'Demi keamanan, setidaknya password harus berisi :min karakter.'
            ]
        );

        try{

            $user = User::where('nrk','=',$this->cache_nrk)->first();
            $user->password = Hash::make($this->password);
            $user->save();
            session()->flash('form-success','Berhasil mengganti password akun '.$this->cache_nama);
            $this->password = "";

        }
        catch(Throwable $e)
        {
            error_log('Gagal mengubah password '.$e);
            report('Gagal mengubah password '.$e);
            session()->flash('form-fail','Gagal melakukan perubahan password');
        }
    }

    public function koreksiPenempatanDanGrup()
    {

        try{

            /**
             * Agar tidak ada pegawai yang seharusnya tidak termasuk anggota pos, tapi masuk pos
             * Hal tersebut akan mempengaruhi perhitungan apd untuk pos-posan
             * Pegawai tersebut harusnya ditempatkan di nama sektor saja, tidak perlu di kantor sektor atau pos
             * Contoh pegawai tersebut seperti :
             * staff, danton, kepala sektor
             * rules : 
             * - pegawai yang tidak piket, tidak boleh ditempatkan di pos / kantor sektor, melainkan di nama sektor
             * - pegawai yang piket, tidak boleh ditempatkan di nama sektor, melainkan di pos / kantor sektor
             * - nama sektor khusus pegawai yang tidak piket atau pegawai yang baru pindah dan belum diberikan penempatan
             */

            // cek penempatan dan grup tidak kosong
            if($this->penempatan != "" && $this->grup != "")
            {
                // jika user merupakan petugas lapangan
                if($this->tipe_jabatan_user == $this->tipe_jabatan_personil) // tambahkan jabatan dengan in_array jika perlu
                {
                    // jika penempatannya menggunakan nama sektor
                    if($this->penempatan == Auth::user()->data->sektor)
                    {
                        $tempat = Penempatan::where('id_penempatan','=',Auth::user()->data->sektor)->first()->nama_penempatan;
                        $this->penempatan = "";
                        session()->flash('warning-penempatan','Penempatan '.$tempat.' hanya untuk yang tidak memiliki grup jaga.');
                    }

                    // jika grup jaganya bukan abc
                    if(!in_array($this->grup,["A","B","C"]))
                    {
                        $this->grup = "";
                        session()->flash('warning-grup','Pilih kembali grup jaga.');
                    }
                }
                else
                {
                    if($this->penempatan != Auth::user()->data->sektor)
                    {
                        $tempat = Penempatan::where('id_penempatan','=',Auth::user()->data->sektor)->first()->nama_penempatan;
                        $this->penempatan = "";
                        session()->flash('warning-penempatan','Pilih penempatan '.$tempat.' untuk yang tidak memiliki grup jaga.');
                    }

                    if(in_array($this->grup,["A","B","C"]) && $this->tipe_jabatan_user != $this->tipe_jabatan_danton) // tambahkan jabatan dengan in_array jika perlu
                    {
                        $this->grup = "";
                        session()->flash('warning-grup','Grup jaga ABC hanya untuk yang melaksanakan piket jaga.');
                    }
                }
            }
        }
        catch(Throwable $e)
        {
            error_log('Terjadi kesalahan saat mengganti grup jaga. '.$e);
            report('Terjadi kesalahan saat mengganti grup jaga. '.$e);
            session()->flash('error-data-penempatan','Terjadi kesalahan saat mengganti grup jaga.');
            $this->grup = "";
        }


    }

    public function dataPegawaiAdaYangDirubah():bool
    {
        return 
            ($this->nama != $this->cache_nama) ||
            ($this->nip != $this->cache_nip) ||
            ($this->nrk != $this->cache_nrk) ||
            ($this->email != $this->cache_email) ||
            ($this->telp != $this->cache_telp) ||
            ($this->aktif != $this->cache_aktif);
    }

}
