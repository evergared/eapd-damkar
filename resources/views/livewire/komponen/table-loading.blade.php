<div>
    <div>
        Status : <span wire:loading>
                    <strong class="text-info">Memuat data...</strong>
                </span>
    <span wire:loading.remove><strong>@if(isset($detik)) Tabel refresh tiap {{$detik}} detik. @else Tabel Standby. @endif </strong></span>
    </div>
</div>