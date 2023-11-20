<div>
    <ol>
        @forelse ($data as $item)
            <li>
                <strong>{{$item['jenis']}}</strong>
                <ul>
                @forelse ($item['opsi'] as $opsi)
                    <li>{{$opsi}}</li>
                @empty
                    
                @endforelse
                </ul>
            </li>
        @empty
            -
        @endforelse
    </ol>
</div>