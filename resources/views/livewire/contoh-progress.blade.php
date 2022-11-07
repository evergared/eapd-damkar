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

    @push('head-js')
    <script type="module">
        Echo.channel('tes').listen('.ContohEvent',(e)=>{
            console.log('contoh event triggered by pusher web');
        })

        Echo.channel('tes').listen('ContohEvent',(e)=>{
            console.log('contoh event triggered by pusher laravel');
        })
    </script>
    @endpush
</div>