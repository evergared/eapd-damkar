<?php

namespace App\Models\Eapd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = "jabatan";

    protected $fillable = [
        'id_jabatan',
        'nama_jabatan',
        'tipe_jabatan',
        'keterangan',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', 'id_jabatan');
    }


    // https://laravel.com/docs/9.x/eloquent-relationships#filtering-queries-via-intermediate-table-columns
    // https://laracasts.com/discuss/channels/eloquent/how-to-filterselect-on-intermediate-pivot-table-columns-in-laravel-54
    public function templatePadaPeriode($id_periode)
    {
        return $this->belongsToMany(InputApdTemplate::class, 'pivot_input_apd_template', 'id_jabatan', 'id_template', 'id_jabatan', 'id')->wherePivot('id_periode', '=', $id_periode);
    }
}
