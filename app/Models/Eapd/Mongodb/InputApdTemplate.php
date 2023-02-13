<?php

namespace App\Models\Eapd\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class InputApdTemplate extends Model
{

    protected $collection = 'input_apd_template';

    protected $fillable = [
        '_id',
        'template'
    ];


    public function template(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    /**
     * Ambil template input apd untuk jabatan dan pada periode tertentu
     * @param mixed $id_jabatan id dari jabatan yang dicari. jika kosong, jabatan L001 akan dipakai
     * @param mixed $id_periode id dari periode yang dicari. jika kosong, periode urutan pertama pada db akan dipakai
     * @return mixed Template yang digunakan untuk dasar inputan
     */
    public function templateBerdasarkanJabatan($id_jabatan = null,$id_periode = null)
    {
        if($id_periode === null)
        {
            $id_periode = PeriodeInputApd::first()->id;
        }

        if($id_jabatan === null)
        {
            // untuk test
            $id_jabatan = 'L001';
        }

        return self::where('jabatan','contains',$id_jabatan)->where('periode','contains',$id_periode)->id;

        // return $this->belongsToMany(Jabatan::class,null,'jabatan','_id')->wherePivot('jabatan');
        // return $this->belongsToMany(Jabatan::class,null, 'jabatan_id','input_apd_template_id');
    }

    public function periode()
    {
        return $this->belongsToMany(PeriodeInputApd::class,null,'periode_input_apd_id','input_apd_template_id');
        // return $this->belongsToMany(PeriodeInputApd::class)->wherePivot('pivot_input_apd_template', 'id_periode');
    }

}
