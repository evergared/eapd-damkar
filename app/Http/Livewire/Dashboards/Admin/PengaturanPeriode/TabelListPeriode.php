<?php

namespace App\Http\Livewire\Dashboards\Admin\PengaturanPeriode;

use App\Models\InputApdTemplate;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PeriodeInputApd;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Throwable;

class TabelListPeriode extends DataTableComponent
{
    protected $model = PeriodeInputApd::class;
    protected $index = 0;

    protected $listners = [
        "refreshTabelListPeriode"
    ];

    #region rappasoft function
    public function configure(): void
    {
        $this->setPrimaryKey('id_periode');
        $this->setRefreshVisible();
        $this->setAdditionalSelects(['nama_periode', 'tgl_awal', 'tgl_akhir', 'aktif']);
    }

    public function columns(): array
    {
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return [
            // Column::make("No", "")
            //     ->format(fn () => ++$this->index)
            //     ->sortable(),
            Column::make("ID", "id_periode")
                ->deselected()
                ->sortable(),
            Column::make("Nama periode", "nama_periode")
                ->sortable(),
            Column::make("Tgl awal", "tgl_awal")
                ->sortable(),
            Column::make("Tgl akhir", "tgl_akhir")
                ->sortable(),
            BooleanColumn::make('Masa Input Data APD?', "aktif")
                ->sortable(),
            BooleanColumn::make('Masa Kumpul Data Ukuran?', "kumpul_ukuran")
                ->sortable(),
            BooleanColumn::make('Masa Rekapitulasi?', "kumpul_rekap")
                ->sortable(),
            Column::make('Tindakan')
                ->label(function ($row) {
                    return view('livewire.dashboards.admin.pengaturan-periode.kolom-tindakan-tabel-list-periode', ['id' => $row->id_periode, 'aktif' => $row->aktif, 'kumpul_ukuran' => $row->kumpul_ukuran, 'kumpul_rekap'=>$row->kumpul_rekap]);
                })
        ];
    }
    #endregion

    public function refreshTabelListPeriode()
    {
        $this->emitSelf("refreshDatatable");
    }

    public function Clone($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $template = InputApdTemplate::where('id_periode', $value)->get()->first();

            $newPeriode = new PeriodeInputApd;
            $newPeriode->nama_periode = "salinan " . $periode->nama_periode;
            $newPeriode->tgl_awal = $periode->tgl_awal;
            $newPeriode->tgl_akhir = $periode->tgl_akhir;
            $newPeriode->pesan_berjalan = $periode->pesan_berjalan;
            $newPeriode->aktif = false;
            $newPeriode->save();

            $newTemplate = new InputApdTemplate;
            $newTemplate->nama = 'template inputan ' . $newPeriode->nama_periode;
            $newTemplate->id_periode = $newPeriode->id_periode;
            $newTemplate->template = $template->template;
            $newTemplate->save();

            $this->emit("refreshTabelListPeriode");
            session()->flash("card_list_periode_success", "Berhasil menggandakan periode! Tunggu sesaat untuk melihat hasil.");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam cloning periode " . $e);
            session()->flash("card_list_periode_danger", "Gagal menggandakan periode!");
        }
    }

    public function TesPesanBerjalan($value)
    {
        try {

            if ($pesan = PeriodeInputApd::find($value)->pesan_berjalan)
                $this->emitTo('eapd.layout.layout-marquee-pengumuman-berjalan', 'TerimaPesanTes', $pesan);
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengetes pesan periode " . $e);
        }
    }

    public function Aktifkan($value)
    {
        try {

            PeriodeInputApd::where("aktif", true)->update(['aktif' => false]);

            $periode = PeriodeInputApd::find($value);
            $periode->aktif = true;
            $periode->save();
            $this->emit("refreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode " . $e);
        }
    }

    public function AktifkanKumpulUkuran($value)
    {
        try {

            PeriodeInputApd::where("kumpul_ukuran", true)->update(['kumpul_ukuran' => false]);

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_ukuran = true;
            $periode->save();
            $this->emit("refreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode " . $e);
        }
    }

    public function AktifkanKumpulRekap($value)
    {
        try {

            PeriodeInputApd::where("kumpul_rekap", true)->update(['kumpul_rekap' => false]);

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_rekap = true;
            $periode->save();
            $this->emit("refreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengaktifkan periode " . $e);
        }
    }

    public function NonAktifkan($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $periode->aktif = false;
            $periode->save();
            $this->emit("refreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode " . $e);
        }
    }

    public function NonAktifkanKumpulUkuran($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_ukuran = false;
            $periode->save();
            $this->emit("refreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode " . $e);
        }
    }

    public function NonAktifkanKumpulRekap($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $periode->kumpul_rekap = false;
            $periode->save();
            $this->emit("refreshTabelListPeriode");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam mengnonaktifkan periode " . $e);
        }
    }

    public function Detil($value)
    {
        $this->dispatchBrowserEvent('hideTabelTemplate');
        $this->dispatchBrowserEvent('hideFormPeriode');
        $this->emit('editPeriode',$value);
    }

    public function EditTemplate($id_periode)
    {
        $this->dispatchBrowserEvent('hideTabelTemplate');
        $this->dispatchBrowserEvent('hideFormPeriode');
        $this->emit('inisiasiTabelTemplate',$id_periode);
        $this->dispatchBrowserEvent('tampilTabelTemplate');
    }

    public function Hapus($value)
    {
        try {

            $periode = PeriodeInputApd::find($value);
            $template = InputApdTemplate::where('id_periode', $value)->get()->first();

            $periode->delete();
            $template->delete();
            $this->emit("refreshTabelListPeriode");
            session()->flash("card_list_periode_success", "Berhasil menghapus periode yang dipilih.");
        } catch (Throwable $e) {
            error_log("Tabel List Periode : Gagal dalam menghapus periode " . $e);
            session()->flash("card_list_periode_danger", "Gagal menghapus periode yang dipilih.");
        }
    }
}
