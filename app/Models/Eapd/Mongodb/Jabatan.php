<?php

namespace App\Models\Eapd\Mongodb;

// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;

class Jabatan extends Model
{

    protected $collection = "jabatan";

    protected $fillable = [
        'nama_jabatan',
        'tipe_jabatan',
        'keterangan',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', '_id');
    }


    // https://laravel.com/docs/9.x/eloquent-relationships#filtering-queries-via-intermediate-table-columns
    // https://laracasts.com/discuss/channels/eloquent/how-to-filterselect-on-intermediate-pivot-table-columns-in-laravel-54
    public function templatePadaPeriode()
    {
        //return $this->belongsToMany(InputApdTemplate::class, 'pivot_input_apd_template', 'id_jabatan', 'id_template', 'id_jabatan', 'id')->wherePivot('id_periode', '=', $id_periode);
        // return $this->belongsToMany(InputApdTemplate::class, null, 'jabatan_id', 'input_apd_template_id','_id','jabatan_id')->wherePivot('periode_input_apd_id', '=', $id_periode);
        return $this->belongsToMany(InputApdTemplate::class, null, 'jabatan_id','input_apd_template_id');
    }
}
