<div>
    @isset($pesan)
        @if (is_string($pesan))
            <small><strong class="text-muted">{{$pesan}}</strong></small>
        @elseif(is_array($pesan))
            @foreach ($pesan as $p)
                <small><strong class="text-muted">{{$p}}</strong></small><br>
            @endforeach
        @endif
    @endisset
</div>