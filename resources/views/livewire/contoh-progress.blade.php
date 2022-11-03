<div wire:init='update'>
    <div>
        progress pengisian email : {{ $email }} dari {{ $totalRow }} ({{ $emailPersen }}%)
    </div>
    <div>
        progress pengisian no telpon : {{ $telpon }} dari {{ $totalRow }} ({{ $telponPersen }}%)
    </div>
    <div>
        progress pengisian foto profile : {{ $profil }} dari {{ $totalRow }} ({{ $profilPersen }}%)
    </div>
    @if ($message)
    <div>
        {{ $message }}
    </div>
    @endif
</div>