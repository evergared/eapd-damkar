<div>
    @if ($data)
    <ul>
        @foreach ($data as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
        
    @endif
</div>