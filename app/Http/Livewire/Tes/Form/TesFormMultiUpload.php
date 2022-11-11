<?php

namespace App\Http\Livewire\Tes\Form;

use Livewire\Component;
use App\Models\Tes\TesMultiUpload as Tes;
use Livewire\WithFileUploads;
use App\Http\Controllers\FileController;
use Illuminate\Support\Str;

class TesFormMultiUpload extends Component
{
    use WithFileUploads;

    public $ida, $nama;
    public  $foto = [],
        $uploadedFoto;

    public $listeners = [
        'edit-profil' => 'editProfil'
    ];

    public function render()
    {
        return view('tes.livewire.form.tes-form-multi-upload');
    }

    public function editProfil($ida)
    {
        $this->resetProfil();
        $model = Tes::find($ida);

        $this->ida = $model->id;
        $this->nama = $model->nama;
        $this->uploadedFoto = json_decode($model->foto, true);
    }

    public function resetProfil()
    {

        $this->ida = null;
        $this->nama = null;
        $this->uploadedFoto = null;
        $this->foto = [];
    }

    public function simpanProfil()
    {
        $this->validate([
            "foto.*" => "image|max:10240"
        ]);

        $listFoto = [];
        $namaRandom = Str::random();
        $iterasi = 0;

        foreach ($this->foto as $f) {
            $namaFile = $namaRandom . '_' . $iterasi . '.jpg';
            error_log($namaFile);
            $f->storeAs(FileController::$testUploadBasePath, $namaFile);
            array_push($listFoto, $namaFile);
            $iterasi++;
        }

        $model = Tes::find($this->ida);
        error_log($model);

        // $listFoto = json_encode($listFoto);

        error_log(implode('|', $listFoto));
        $model->foto = json_encode($listFoto);

        $model->save();

        $this->resetProfil();
        $this->emit('refreshLivewireDatatable');
    }
}
