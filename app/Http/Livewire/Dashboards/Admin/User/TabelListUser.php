<?php

namespace App\Http\Livewire\Dashboards\Admin\User;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use App\Models\Wilayah;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Throwable;

class TabelListUser extends DataTableComponent
{
    protected $model = User::class;

    public string $tableName = "Tabel_List_User";
    public array $TabelListUser = [];

    public $columnSearch = [
        'nip' => [],
        'nrk' => [],
        'penempatan' => [],
        'jabatan' => [],
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id_pegawai');
    }

    public function builder(): Builder
    {
        $query = User::query()->where('user.id_pegawai','ini cuman dummy pak');

        if(Auth::guard('admin'))
        {
            $tipe_admin = Auth::user()->tipe_admin;

            $query = User::query();


            if( $tipe_admin == "Admin Dinas")
            {
                $query = $query;
            }
            elseif($tipe_admin == "Admin Sudin")
            {
                $query = $query->where('data.aktif',true)
                        ->where('data.penempatan.id_wilayah',Auth::user()->data->penempatan->id_wilayah)
                        ->where(function($builder){
                            return $builder->where('data.penempatan.tipe','sudin')
                                        ->orWhere('data.penempatan.tipe','sektor')
                                        ->orWhere('data.penempatan.tipe','pos');
                        });
            }
            elseif($tipe_admin == "Admin Subcc")
            {
                $query = $query->where('data.aktif',true)
                        ->where('data.penempatan.id_wilayah',Auth::user()->data->penempatan->id_wilayah)
                        ->where('data.penempatan.tipe','subcc');
            }
            elseif($tipe_admin == "Admin Pusdik")
            {
                $query = $query->where('data.aktif',true)
                        ->where('data.penempatan.tipe','diklat');
            }
            elseif($tipe_admin == "Admin Lab")
            {
                $query = $query->where('data.aktif',true)
                ->where('data.penempatan.tipe','lab');
            }
            elseif($tipe_admin == "Admin Bidops")
            {
                $query = $query->where('data.aktif',true)
                ->where('data.penempatan.tipe','bidops');
            }
            elseif($tipe_admin == "Admin Sektor")
            {
                $query = $query->where('data.aktif',true)
                            ->where('data.id_penempatan','like',Auth::user()->id_penempatan.'%')
                            ->where(function($builder){
                                return $builder->where('data.penempatan.tipe','sektor')
                                            ->orWhere('data.penempatan.tipe','pos');
                            });
            }

            $query->when($this->columnSearch['nip'] ?? null, function($query, $nip){
                return $query->where('nip', 'like', '%'.$nip.'%');
            })
            ->when($this->columnSearch['nrk'] ?? null, function($query, $nrk){
                return $query->where('nrk', 'like', '%'.$nrk.'%');
            })
            ->when($this->columnSearch['penempatan'] ?? null, function($query, $penempatan){
                return $query->where('penempatan.nama_penempatan', 'like', '%'.$penempatan.'%');
            })
            ->when($this->columnSearch['jabatan'] ?? null, function($query, $jabatan){
                return $query->where('jabatan.nama_jabatan', 'like', '%'.$jabatan.'%');
            });

        }

        

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make("Id pegawai", "id_pegawai")
                ->hideIf(true),
            Column::make("NIP/NIK", "data.nip")
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'nip']);
                }),
            Column::make("NRK/ID PJLP", "data.nrk")
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'nrk']);
                }),
            Column::make("Nama Pegawai", "data.nama")
                ->sortable()
                ->searchable(),
            BooleanColumn::make("Pegawai Aktif?", "data.aktif")
                ->sortable()
                ->secondaryHeaderFilter('aktif')
                ->hideIf(Auth::user()->tipe != "Admin Dinas"),
            Column::make("Jabatan", "data.jabatan.nama_jabatan")
                ->sortable()
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'jabatan']);
                }),
            Column::make("Penempatan", "data.penempatan.nama_penempatan")
                ->secondaryHeader(function(){
                    return view('livewire.komponen.table-searchheader',['field'=>'penempatan']);
                })
                ->sortable(),
            Column::make("Wilayah", "data.penempatan.wilayah.nama_wilayah")
                ->hideIf(Auth::user()->tipe != "Admin Dinas")
                ->secondaryHeaderFilter('wilayah')
                ->sortable(),
            Column::make("Tindakan")
                ->hideIf(Auth::user()->tipe != "Admin Dinas")
                ->label(function($row){
                    return view('livewire.dashboards.admin.user.kolom-tindakan-akun',['id' => $row->id_pegawai]);
                })    
        ];
    }

    public function filters(): array
    {

        $opsi_aktif = [
            '' => 'Semua',
            '1' => "Aktif",
            '0' => "Non-Aktif"
        ];

        $opsi_wilayah = [
            '' => 'Semua'
        ];

        $wilayah = Wilayah::all();
        foreach($wilayah as $w)
            $opsi_wilayah[$w->id_wilayah] = $w->nama_wilayah;

        return [
            SelectFilter::make('Aktif', 'aktif')
                ->setFilterPillTitle('Aktif')
                ->options($opsi_aktif)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('aktif',$value);
                    }
                }),
                SelectFilter::make('Wilayah', 'wilayah')
                ->setFilterPillTitle('Wilayah')
                ->options($opsi_wilayah)
                ->filter(function(Builder $builder, string $value) {
                    if($value != '')
                    {
                        $builder->where('penempatan.id_wilayah',$value);
                    }
                }),
        ];
    }

    public function resetPassword($id)
    {
        try{

            $user = User::find($id);

            if(is_null($user))
                throw new Exception("User dengan id : ".$id." tidak ditemukan");
            
            $user->password = Hash::make('123456');

            $user->save();

            $this->dispatchBrowserEvent('jsToast',[
                                                "class"=>'bg-success',
                                                "title"=>"Reset Password Berhasil!",
                                                "subtitle"=>"Tabel User Pegawai",
                                                "body"=>"Password user pegawai ".$user->data->nama." telah di reset menjadi 123456."
                                            ]);

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Tabel List User @ User Dashboard Admin error ref ('.$time.') : Kesalahan saat reset password '.$e);
            Log::error('Tabel List User @ User Dashboard Admin error ref ('.$time.') : Kesalahan saat reset password '.$e);
            
            $this->dispatchBrowserEvent('jsToast',[
                "class"=>'bg-danger',
                "title"=>"Gagal Reset Password!",
                "subtitle"=>$time,
                "body"=>"Terjadi kesalahan saat reset password user pegawai"
            ]);

        }
    }

    public function hapusAkun($id)
    {
        try{

            $user = User::find($id);

            if(is_null($user))
                throw new Exception("User dengan id : ".$id." tidak ditemukan");
            
            $user->delete();

            $this->dispatchBrowserEvent('jsToast',[
                                                "class"=>'bg-success',
                                                "title"=>"Hapus Akun Berhasil!",
                                                "subtitle"=>"Tabel User Pegawai",
                                                "body"=>"Akun user pegawai ".$user->data->nama." telah berhasil dihapus."
                                            ]);

        }
        catch(Throwable $e)
        {
            $time = now();
            error_log('Tabel List User @ User Dashboard Admin error ref ('.$time.') : Kesalahan mencoba menghapus akun '.$e);
            Log::error('Tabel List User @ User Dashboard Admin error ref ('.$time.') : Kesalahan mencoba menghapus akun '.$e);
            
            $this->dispatchBrowserEvent('jsToast',[
                "class"=>'bg-danger',
                "title"=>"Gagal menghapus!",
                "subtitle"=>$time,
                "body"=>"Terjadi kesalahan saat menghapus akun pegawai"
            ]);

        }
    }
}
