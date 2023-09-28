<?php

namespace App\Models\TidakDigunakan;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Alexzvn\LaravelMongoNotifiable\Notifiable;

use Alexzvn\LaravelMongoNotifiable\Notifiable;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

// untuk mongodb
class User extends Authenticatable
{
    // Jika ingin menggunakan file ini, taruh di folder Models

    use HasApiTokens,  Notifiable;

    protected $collection = 'user';
    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        '_id',
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
        return $this->belongsTo(Pegawai::class,'_id');
    }

    public function getNamaAttribute()
    {
        return Pegawai::where('_id', '=', $this->_id)->first()->nama;
    }

}
