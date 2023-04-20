<?php

namespace App\Http\Livewire\Eapd\Modal;

use App\Models\Eapd\Mongodb\Grup;
use App\Models\Eapd\Mongodb\Pegawai;
use App\Models\Eapd\Mongodb\Penempatan;
use App\Models\User;
use App\Enum\TipeJabatan;
use App\Models\Eapd\Mongodb\HistoryTabelPegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Throwable;

class ModalEditDataPegawaiTabelAdminSudin extends Component
{

    // data untuk option select
    public
        $list_penempatan = [],
        $list_grup = [],
        $list_sektor = [],
        $list_aktif = [
            ['value' => '1', 'text' => "Masih Aktif"],
            ['value' => '0', 'text' => "Tidak Aktif / Pensiun"],
        ];

    // data pegawai yang dipanggil
    public
        $id_pegawai = "",
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
        $tipe_jabatan_user = "",
        $sektor = "";

    // untuk menyimpan data awal
    public
        $cache_nrk = "",
        $cache_nip = "",
        $cache_nama = "",
        $cache_grup = "",
        $cache_penempatan = "",
        $cache_email = "",
        $cache_telp = "",
        $cache_aktif = "",
        $cache_sektor = "";

    // untuk ditampilkan di ubah penempatan
    public
        $jabatan_pegawai = "";

    // untuk menampilkan atau tidaknya ubah password
    public
        $user_ditemukan = false;

    // untuk perbandingan tipe jabatan
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
        return view('eapd.livewire.modal.modal-edit-data-pegawai-tabel-admin-sudin');
    }

    /**
     * @todo
     */
    public function inisiasiModal($value)
    {
        try {
            // ambil id_pegawai
            $this->id_pegawai =  $value;


            // ambil data pegawai
            $pegawai = Pegawai::where('_id', '=', $this->id_pegawai)->first();

            // inisiasi data lainnya
            $this->nrk = $this->cache_nrk = $pegawai->nrk;
            $this->nama = $this->cache_nama = $pegawai->nama;
            $this->nip = $this->cache_nip = $pegawai->nip;
            $this->grup = $this->cache_grup = $pegawai->id_grup;
            $this->penempatan = $this->cache_penempatan = $pegawai->id_penempatan;
            $this->email = $this->cache_email = $pegawai->email;
            $this->telp = $this->cache_telp = $pegawai->no_telp;
            $this->aktif = $this->cache_aktif = $pegawai->aktif;
            $this->sektor = $this->cache_sektor = $pegawai->sektor;

            $this->jabatan_pegawai = $pegawai->jabatan->nama_jabatan;
            $this->tipe_jabatan_user = $pegawai->jabatan->tipe_jabatan;

            $this->tipe_jabatan_personil = TipeJabatan::personil()->value;
            $this->tipe_jabatan_danton = TipeJabatan::danton()->value;

            //ambil data pos sektor
            $this->list_penempatan = [];
            error_log("sektor : ".$this->sektor);
            $query_penempatan = Penempatan::where('id_wilayah', '=', Auth::user()->data->id_wilayah)
                ->where('_id','like',$this->sektor.'%')
                ->where('keterangan','pos')
                ->get();

            foreach ($query_penempatan as $q) {
                array_push($this->list_penempatan, [
                    'value' => $q->id,
                    'text' => $q->nama_penempatan
                ]);
            }

            // ambil data grup
            $this->list_grup = [];

            $query_grup = Grup::all();

            foreach ($query_grup as $q) {
                array_push($this->list_grup, [
                    'value' => $q->id_grup,
                    'text' => $q->nama_grup
                ]);
            }

            // ambil data list sektor di suatu wilayah
            $this->list_sektor = [];

            $query_sektor = Penempatan::where('id_wilayah',Auth::user()->data->penempatan->id_wilayah)->where('keterangan','sektor')->get();

            foreach($query_sektor as $q)
            {
                array_push($this->list_sektor,[
                    'value' => $q->id,
                    'text' => $q->nama_penempatan
                ]);
            }

            // cek apakah ada user dengan id_pegawai tersebut
            $this->user_ditemukan = User::where('_id', '=', $this->id_pegawai)->first() != "";


            $this->koreksiPenempatanDanGrup();
        } catch (Throwable $e) {
            error_log('gagal inisiasi modal edit data pegawai ' . $e);
        }
    }

    public function simpanPerubahanData()
    {
        $id_pegawai = "";

        // proses menyimpan perubahan data
        try {

            // ambil data pegawai mana yang mau diubah
            $pegawai = Pegawai::where('_id', '=', $this->id_pegawai)->first();

            // ambil perubahan dari input di modal
            $pegawai->id_grup = $this->grup;
            $pegawai->id_penempatan = $this->penempatan;
            $pegawai->nama = $this->nama;
            $pegawai->id = $this->id_pegawai;
            $pegawai->nip = $this->nip;
            $pegawai->email = $this->email;
            $pegawai->no_telp = $this->telp;
            $pegawai->aktif = $this->aktif;

            $id_pegawai = $pegawai->id;

            // simpan atau update melalui eloquent model
            $pegawai->save();

            // ambil id pegawai yang barusan di update
            // $id_pegawai = $pegawai->{$pegawai->getKeyName()};
            error_log('id pegawai dari modal : ' . $id_pegawai);

            // ambil data pegawai
            $pegawai = Pegawai::where('_id', '=', $id_pegawai)->first();

            // inisiasi ulang data lainnya
            $this->id_pegawai = $pegawai->id;
            $this->nrk = $this->cache_nrk = $pegawai->nrk;
            $this->nama = $this->cache_nama = $pegawai->nama;
            $this->nip = $this->cache_nip = $pegawai->nip;
            $this->grup = $this->cache_grup = $pegawai->id_grup;
            $this->penempatan = $this->cache_penempatan = $pegawai->id_penempatan;
            $this->email = $this->cache_email = $pegawai->email;
            $this->telp = $this->cache_telp = $pegawai->no_telp;
            $this->aktif = $this->cache_aktif = $pegawai->aktif;

            // tampilkan pesan
            session()->flash('form-success', 'Berhasil melakukan perubahan data.');

            // refresh datatable
            $this->emit('refreshDatatable');
        } catch (Throwable $e) {
            if (is_null($pegawai) && $id_pegawai != "") {
                session()->flash('form-success', 'Berhasil melakukan perubahan data, namun terjadi kesalahan saat mengambil data yang telah diubah.');
                error_log('Gagal mengambil data setelah perubahan berhasil ' . $e);
            } else {
                session()->flash('form-fail', 'Gagal melakukan perubahan data.');
                error_log('Gagal melakukan perubahan data ' . $e);
            }
        }

        // proses menyimpan keterangan admin (bila ada)
        if ($this->keterangan != "" && $id_pegawai != "") {
            try {
                error_log('hit keterangan edit user ' . $id_pegawai);
                $history = HistoryTabelPegawai::where('id_pegawai', '=', $id_pegawai)->first();
                $history->keterangan_perubahan = $this->keterangan;

                $history->save();
                $this->keterangan = "";
            } catch (Throwable $e) {
                error_log('Gagal menambahkan keterangan perubahan pada data pegawai yang telah diubah ' . $e);
            }
        }
    }

    public function simpanPerubahanPassword()
    {
        // validasi password yang diinput
        $this->validate(
            ['password' => 'required|min:6'],
            [
                'password.required' => 'Field ini tidak boleh kosong untuk mengganti password.',
                'password.min' => 'Demi keamanan, setidaknya password harus berisi :min karakter.'
            ]
        );

        try {

            error_log('passwrod ' . $this->password);
            // ambil user mana yang akan diubah passwordnya
            $user = User::where('_id', '=', $this->id_pegawai)->first();
            // buat password dari inputan
            $user->password = Hash::make($this->password);
            // simpan perubahan
            $user->save();
            // tampilkan pesan
            session()->flash('form-success', 'Berhasil mengganti password akun ' . $this->cache_nama);
            // hapus isi dari input password
            $this->password = "";
        } catch (Throwable $e) {
            error_log('Gagal mengubah password ' . $e);
            report('Gagal mengubah password ' . $e);
            session()->flash('form-fail', 'Gagal melakukan perubahan password');
        }
    }

    public function resetPerubahanData()
    {
        $this->nrk = $this->cache_nrk;
        $this->nama = $this->cache_nama;
        $this->nip = $this->cache_nip;
        $this->grup = $this->cache_grup;
        $this->penempatan = $this->cache_penempatan;
        $this->email = $this->cache_email;
        $this->telp = $this->cache_telp;
        $this->aktif = $this->cache_aktif;
        $this->sektor = $this->cache_sektor;
    }

    public function koreksiPenempatanDanGrup()
    {

        try {

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
            if ($this->penempatan != "" && $this->grup != "") {
                // jika user merupakan petugas lapangan
                if ($this->tipe_jabatan_user == $this->tipe_jabatan_personil) // tambahkan jabatan dengan in_array jika perlu
                {
                    // jika penempatannya menggunakan nama sektor
                    if ($this->penempatan == Auth::user()->data->sektor) {
                        $tempat = Penempatan::where('_id', '=', Auth::user()->data->sektor)->first()->nama_penempatan;
                        $this->penempatan = "";
                        session()->flash('warning-penempatan', 'Penempatan ' . $tempat . ' hanya untuk yang tidak memiliki grup jaga.');
                    }

                    // jika grup jaganya bukan abc
                    if (!in_array($this->grup, ["A", "B", "C"])) {
                        $this->grup = "";
                        session()->flash('warning-grup', 'Pilih kembali grup jaga.');
                    }
                } else {
                    if ($this->penempatan != Auth::user()->data->sektor) {
                        $tempat = Penempatan::where('_id', '=', Auth::user()->data->sektor)->first()->nama_penempatan;
                        $this->penempatan = "";
                        session()->flash('warning-penempatan', 'Pilih penempatan ' . $tempat . ' untuk yang tidak memiliki grup jaga.');
                    }

                    if (in_array($this->grup, ["A", "B", "C"]) && $this->tipe_jabatan_user != $this->tipe_jabatan_danton) // tambahkan jabatan dengan in_array jika perlu
                    {
                        $this->grup = "";
                        session()->flash('warning-grup', 'Grup jaga ABC hanya untuk yang melaksanakan piket jaga.');
                    }
                }
            }
        } catch (Throwable $e) {
            error_log('Terjadi kesalahan saat mengganti grup jaga. ' . $e);
            report('Terjadi kesalahan saat mengganti grup jaga. ' . $e);
            session()->flash('error-data-penempatan', 'Terjadi kesalahan saat mengganti grup jaga.');
            $this->grup = "";
        }
    }

    public function optionSektorDiganti()
    {
        $this->list_penempatan = [];
            error_log("sektor : ".$this->sektor);

            $query_penempatan = Penempatan::where('id_wilayah', '=', Auth::user()->data->id_wilayah)
                ->where('_id','like',$this->sektor.'%')
                ->where('keterangan','pos')
                ->get();

            foreach ($query_penempatan as $q) {
                array_push($this->list_penempatan, [
                    'value' => $q->id,
                    'text' => $q->nama_penempatan
                ]);
            }
    }

    public function dataPegawaiAdaYangDirubah(): bool
    {
        return ($this->nama != $this->cache_nama) ||
            ($this->nip != $this->cache_nip) ||
            ($this->nrk != $this->cache_nrk) ||
            ($this->email != $this->cache_email) ||
            ($this->telp != $this->cache_telp) ||
            ($this->aktif != $this->cache_aktif);
    }
}
