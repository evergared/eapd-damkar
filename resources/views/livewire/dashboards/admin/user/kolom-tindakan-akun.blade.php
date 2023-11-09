<div class="btn-group" role="group" aria-label="tindakan">
    <button type="button" class="btn btn-primary mx-1" onclick="confirm('Password akan di reset menjadi 123456, lanjutkan?') || event.stopImmediatePropagation()" wire:click="resetPassword('{{$id}}')">Reset Password</button>
    <button type="button" class="btn btn-danger mx-1" onclick="confirm('Hapus user ini?') || event.stopImmediatePropagation()" wire:click="hapusAkun('{{$id}}')">Hapus Akun</button>
</div>