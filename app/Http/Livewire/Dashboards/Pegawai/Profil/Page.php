<?php

namespace App\Http\Livewire\Dashboards\Pegawai\Profil;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Pegawai;
use App\Http\Controllers\FileController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Page extends Component
{

    use WithFileUploads;
    public $foto, $uploadFoto, $email, $noTelp, $password, $ulangiPassword;
    public  $cacheFoto, $cacheEmail, $cacheNoTelp;
    public $showPassword, $inputType = 'password';

    public function render()
    {
        return view('livewire.dashboards.pegawai.profil.page')->layout('livewire.layouts.adminlte-dashboard', ['page_title' => 'Profil Pegawai']);
    }

    public function mount()
    {

        $this->inisiasi();
    }

    public function updated($property)
    {
        $this->foto = $this->cacheFoto;

        $this->validateOnly(
            $property,
            [
                'uploadFoto' => ['image', 'max:1024'],
                'noTelp' => 'between:6,20',
                'email' => 'email',
            ],
            [
                'noTelp.between' => 'Jumlah digit tidak sesuai dengan ketentuan.',
                'uploadFoto.image' => 'File harus berupa gambar.',
                'uploadFoto.max' => 'Ukuran file terlalu besar (:max kb)',
                'email.email' => 'Mohon gunakan format email yang benar (contoh : contoh@gmail.com)',
            ]
        );

        if (!is_null($this->uploadFoto)) {
            $fc = new FileController;
            $this->foto = $fc->prosesNamaFileAvatarUpload(Auth::user()->id);
        }
    }


    public function updatedShowPassword()
    {
        switch ($this->showPassword) {
            case true:
                $this->inputType = 'text';
                break;
            case false:
                $this->inputType = 'password';
                break;
            default:
                $this->inputType = 'password';
                break;
        }
    }



    public function inisiasi()
    {
        $pegawai = Pegawai::where('id_pegawai', '=', Auth::User()->id_pegawai)->first();

        if (is_null($pegawai->profile_img)) {
            $this->cacheFoto = $this->foto = asset(FileController::$avatarPlaceholder);
        } else {
            $this->cacheFoto = $this->foto = asset('storage/' . FileController::$avatarUploadBasePath . '/' . $pegawai->profile_img);
        }

        $this->cacheEmail = $this->email = $pegawai->email;
        $this->cacheNoTelp = $this->noTelp = $pegawai->no_telp;
    }

    public function simpanPerubahan()
    {
        error_log('simpan perubahan');

        $this->validate(
            ['password' => 'same:ulangiPassword', 'ulangiPassword' => 'same:password'],
            ['password' => 'Password yang dimasukan tidak sama', 'ulangiPassword' => 'Password yang dimasukan tidak sama']
        );

        if (!is_null($this->password) && $this->password == $this->ulangiPassword)
            User::where('id_pegawai', '=', Auth::User()->id_pegawai)->update(['password' => Hash::make($this->password)]);

        $pegawai = Pegawai::where('id_pegawai', '=', Auth::User()->id_pegawai)->first();

        if ($this->cacheEmail != $this->email)
            $pegawai->email = $this->email;

        if ($this->cacheNoTelp != $this->noTelp)
            $pegawai->no_telp = $this->noTelp;

        if ($this->cacheFoto != $this->foto) {
            $this->uploadFoto->storeAs(FileController::$avatarUploadBasePath, $this->foto);
            $pegawai->profile_img = $this->foto;
        }



        $pegawai->save();

        $this->resetData();
        session()->flash('sukses', 'Data profil berhasil disimpan');
        // return redirect(request()->header('Referer'))->with('sukses', 'Data profil berhasil disimpan');
         $this->inisiasi();
    }


    public function resetData()
    {
        $this->reset(['uploadFoto', 'password', 'ulangiPassword']);
        $this->email = $this->cacheEmail;
        $this->noTelp = $this->cacheNoTelp;
        $this->foto = $this->cacheFoto;
    }

    public function test()
    {
        error_log('biji');
    }
}
