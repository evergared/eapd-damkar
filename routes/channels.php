<?php

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

// Broadcast::channel('tes', function () {             // <---- contoh public channel, laravel-echo dan livewire otomatis handle ini walau tidak dibuat
//     return true;
// });
