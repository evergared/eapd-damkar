<div>
    @if ($data)
    <ul>
        @foreach ($data as $item)
            <li>{{$item['text']}}</li>
        @endforeach
    </ul>
    @endif
</div>