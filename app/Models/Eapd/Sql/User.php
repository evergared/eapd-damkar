<?php

namespace App\Models\Sql;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Eapd\Sql\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// untuk sql
class User extends Authenticatable
{
    // Jika ingin menggunakan file ini, taruh di folder Models

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $keyType = 'string';
    protected $primaryKey = 'userid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userid',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function data()
    {
        return $this->belongsTo(Pegawai::class, 'userid', 'id');
    }

    public function getNamaAttribute()
    {
        return Pegawai::where('id', '=', $this->userid)->first()->nama;
    }

}
