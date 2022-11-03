<div>
    <a href="{{($img ?? null) ? asset('storage/img/avatar/user/'.$img) : asset('storage/img/avatar/placeholder/avatar.jpg')}}"
        style="{{($img ?? null)? : 'pointer-events:none; cursor:default;'}}" target="_blank">
        @if ($img)
        <img class="w-10 h-10 rounded-full" src="{{asset('storage/img/avatar/user/'.$img)}}?{{rand()}}">
        @else
        <img class="w-10 h-10 rounded-full" src="{{asset('storage/img/avatar/placeholder/avatar.jpg')}}">
        @endif
    </a>
</div>