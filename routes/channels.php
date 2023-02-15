<?php

use App\Enum\LevelUser;
use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

/**
 * Closure function pada broadcast private channel:
 * function (args1, args2)
 * args1 : user yang saat ini telah login (setting dari default laravel)
 * args2 : user dari nama channel (setting dari kita)
 */

// Broadcast::channel('tes-private.{channelUser}', function ($user, $channelUser) {   //<---contoh private channel
//     error_log('tes $user : ' . $user->nrk);
//     error_log('tes $channelUser : ' . $channelUser);
//     return $user->nrk === $channelUser;
// });

Broadcast::channel('tes', function () {             // <---- contoh public channel, laravel-echo dan livewire otomatis handle ini walau tidak dibuat
    return true;
});



// private channel 

#region untuk mengirimkan ke pegawai tertentu
Broadcast::channel('pegawai-{id_penerima}',function($user,$id_penerima){
    return $user->id === $id_penerima;
});
#endregion

#region channel admin umum, menjangkau semua admin
Broadcast::channel('admin-sektor',function($user){
    return $user->data->jabatan->level_user == LevelUser::adminSektor();
});

Broadcast::channel('admin-sudin',function($user){
    return $user->data->jabatan->level_user == LevelUser::adminSudin();
});

Broadcast::channel('admin-dinas',function($user){
    return $user->data->jabatan->level_user == LevelUser::adminDinas();
});
#endregion

#region tingkat sektor
Broadcast::channel('admin-sektor-{sektor}',function($user,$sektor){

    return $user->data->jabatan->level_user == LevelUser::adminSektor() && $user->data->sektor == $sektor;

});

Broadcast::channel('danton-{sektor}-{kompi}',function($user,$sektor,$kompi){
    return  $user->data->jabatan->level_user == LevelUser::danton() &&
            $user->data->sektor == $sektor &&
            $user->data->id_grup == $kompi;
});

Broadcast::channel('karu-{sektor}-{id}',function($user, $sektor, $id){
    return  $user->data->jabatan->level_user == LevelUser::karu() &&
            $user->data->sektor == $sektor &&
            $user->id == $id;
});
#endregion